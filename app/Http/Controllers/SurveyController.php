<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use App\Answer;
use App\AuditTrail;
use App\SurveySubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Audience;

class SurveyController extends Controller
{
    public function index()
    {
        $audit_user_id = auth()->user()->id ?? null;
        AuditTrail::create([
            'user_id' => $audit_user_id,
            'controller' => 'SurveyController',
            'function' => 'index',
            'action' => 'View List of Surveys',
        ]);

        // $surveys = Survey::all();
        // return view('surveys.index', compact('surveys'));
        // $surveys = Survey::with('audience')->get(); // Eager load audience
        $surveys = Survey::with('audiences')->get();
        return view('surveys.index', compact('surveys'));
    }



    public function getGuestForm($surveyObfuscator, $questionaireObfuscator)
    {
        // Find the survey by obfuscator
        $survey = Survey::where('obfuscator', $surveyObfuscator)->firstOrFail();
        
        // Find the questionnaire by obfuscator and survey ID
        $questionaire = \App\Questionaire::where('obfuscator', $questionaireObfuscator)
                                        ->where('survey_id', $survey->id)
                                        ->firstOrFail();

        // Fetch valid audiences for the survey
        $audiences = $survey->audiences()->where('validity', true)->pluck('name')->toArray();

        if (empty($audiences)) {
            return redirect()->route('survey.welcome')->with('error', 'No valid audiences available for this survey.');
        }

        // Log for debugging
        Log::info("Guest form accessed: survey_id = {$survey->id}, questionaire_obfuscator = {$questionaireObfuscator}");

        // Render the survey form view
        return view('forms.survey-form', [
            'survey_id' => $survey->id,
            'questionaire' => $questionaire,
            'audiences' => $audiences,
        ]);
    }

    // public function showDepartments($surveyId, $audienceType)
    // {
    //     $survey = Survey::findOrFail($surveyId);
    //     if (!$survey->published) {
    //         return redirect()->route('survey.welcome')->with('error', 'This survey is not published.');
    //     }
    
    //     $questionaire = \App\Questionaire::where('survey_id', $surveyId)
    //                                     ->whereHas('audience', function ($query) use ($audienceType) {
    //                                         $query->where('name', $audienceType);
    //                                     })
    //                                     ->first();
    
    //     if (!$questionaire) {
    //         return redirect()->route('survey.welcome')->with('error', 'No questionnaire found for this survey and audience.');
    //     }
    
    //     $departments = Question::where('survey_id', $surveyId)
    //                            ->where('questionaire_id', $questionaire->id)
    //                            ->where('audience_type', $audienceType)
    //                            ->pluck('department')
    //                            ->unique()
    //                            ->values()
    //                            ->toArray();
    
    //     if (empty($departments)) {
    //         return redirect()->route('survey.welcome')->with('error', 'No departments assigned to this questionnaire.');
    //     }
    
    //     Log::info("Survey ID: $surveyId, Audience Type: $audienceType, Departments: ", $departments);
    
    //     return view('forms.department-selection', [
    //         'survey_id' => $surveyId,
    //         'audience_type' => $audienceType,
    //         'departments' => $departments,
    //         'questionaire' => $questionaire,
    //     ]);
    // }
// public function showDepartments($surveyId, $audienceType)
// {
//     $departments = Question::where('survey_id', $surveyId)
//                            ->where('audience_type', $audienceType)
//                            ->pluck('department')
//                            ->unique()
//                            ->values()
//                            ->toArray();

//     if (empty($departments)) {
//         // Fallback to all active departments if no survey-specific ones exist
//         $departments = \App\Departments::where('is_active', true)
//                                        ->pluck('Name')
//                                        ->values()
//                                        ->toArray();
//     }

    

//     \Illuminate\Support\Facades\Log::info("Survey ID: $surveyId, Audience Type: $audienceType, Departments: ", $departments);

//     return view('forms.department-selection', [
//         'survey_id' => $surveyId,
//         'audience_type' => $audienceType,
//         'departments' => $departments,
//         'questionaire' => (object) ['survey_id' => $surveyId, 'obfuscator' => 'initial-survey']
//     ]);
// }
public function showDepartments($surveyId, $audienceType)
{
    $survey = Survey::findOrFail($surveyId);
    if (!$survey->published) {
        Log::info("Redirecting: Survey {$surveyId} is not published.");
        return redirect()->route('survey.welcome')->with('error', 'This survey is not published.');
    }

    $questionaire = \App\Questionaire::where('survey_id', $surveyId)
                                    ->whereHas('audience', function ($query) use ($audienceType) {
                                        $query->where('name', $audienceType);
                                    })
                                    ->first();

    if (!$questionaire) {
        Log::info("Redirecting: No questionnaire found for survey {$surveyId} and audience {$audienceType}.");
        return redirect()->route('survey.welcome')->with('error', 'No questionnaire found for this survey and audience.');
    }

    $departments = Question::where('survey_id', $surveyId)
                           ->where('questionaire_id', $questionaire->id)
                           ->where('audience_type', $audienceType)
                           ->pluck('department')
                           ->unique()
                           ->values()
                           ->toArray();

    if (empty($departments)) {
        Log::info("Redirecting: No departments found for survey {$surveyId}, audience {$audienceType}, questionnaire {$questionaire->id}.");
        return redirect()->route('survey.welcome')->with('error', 'No departments assigned to this questionnaire.');
    }

    Log::info("Survey ID: $surveyId, Audience Type: $audienceType, Departments: ", $departments);

    return view('forms.department-selection', [
        'survey_id' => $surveyId,
        'audience_type' => $audienceType,
        'departments' => $departments,
        'questionaire' => $questionaire,
    ]);
}

public function manageQuestionnaires($surveyId)
{
    $survey = Survey::with('questionaires')->findOrFail($surveyId);
    $questionaires = $survey->questionaires;

    return view('surveys.manage-questionnaires', compact('survey', 'questionaires'));
}


public function getSurveyQuestions($surveyId, $audienceType, $department)
{
    try {
        Log::info("Starting getSurveyQuestions: surveyId=$surveyId, audienceType=$audienceType, department=$department");

        $survey = Survey::findOrFail($surveyId);
        Log::info("Survey found: " . $survey->title);

        $questions = Question::where('survey_id', $surveyId)
                             ->where('audience_type', $audienceType)
                             ->where('department', $department)
                             ->with('questionType')
                             ->inRandomOrder()
                             ->limit(3)
                             ->get();

        Log::info("Questions found: " . $questions->count());

        if ($questions->isEmpty()) {
            return response()->json(['error' => 'No questions found'], 404);
        }

        // Format the audienceType for display
        $formattedAudienceType = Str::title(str_replace('_', ' ', $audienceType));

        $surveyJson = [
            'title' => "Civil Aviation Authority - {$formattedAudienceType} Survey - {$department}",
            'description' => "Please share your experience with the {$department} department.",
            'pages' => [
                [
                    'name' => 'page1',
                    'elements' => $questions->map(function ($question) {
                        Log::info("Processing question ID: " . $question->id);
                        return [
                            'type' => strtolower($question->questionType->type ?? 'text'), // Fallback
                            'name' => 'question_' . $question->id,
                            'title' => $question->question,
                            'isRequired' => $question->is_required,
                        ];
                    })->toArray()
                ]
            ]
        ];

        $audiences = Audience::where('validity', true)->pluck('name')->toArray();

        Log::info("Success: surveyId=$surveyId, audienceType=$audienceType, department=$department, audiences=", $audiences);

        return view('forms.survey-form', [
            'surveyJson' => json_encode($surveyJson),
            'survey_id' => $surveyId,
            'questionaire' => (object) ['survey_id' => $surveyId, 'obfuscator' => 'initial-survey'],
            'audiences' => $audiences,
            'jurisdiction' => $audienceType
        ]);
    } catch (\Exception $e) {
        Log::error("Error in getSurveyQuestions: " . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
        return response()->json(['error' => 'Server error'], 500);
    }
}

//     public function getSurveyQuestions($surveyId, $audienceType, $department)
// {
//     try {
//         Log::info("Starting getSurveyQuestions: surveyId=$surveyId, audienceType=$audienceType, department=$department");

//         $survey = Survey::findOrFail($surveyId);
//         Log::info("Survey found: " . $survey->title);

//         $questions = Question::where('survey_id', $surveyId)
//                              ->where('audience_type', $audienceType)
//                              ->where('department', $department)
//                              ->with('questionType')
//                              ->inRandomOrder()
//                              ->limit(3)
//                              ->get();

//         Log::info("Questions found: " . $questions->count());

//         if ($questions->isEmpty()) {
//             return response()->json(['error' => 'No questions found'], 404);
//         }

//         $surveyJson = [
//             'title' => "Civil Aviation Authority - {$audienceType} Survey - {$department}",
//             'description' => "Please share your experience with the {$department} department.",
//             'pages' => [
//                 [
//                     'name' => 'page1',
//                     'elements' => $questions->map(function ($question) {
//                         Log::info("Processing question ID: " . $question->id);
//                         return [
//                             'type' => strtolower($question->questionType->type ?? 'text'), // Fallback
//                             'name' => 'question_' . $question->id,
//                             'title' => $question->question,
//                             'isRequired' => $question->is_required,
//                         ];
//                     })->toArray()
//                 ]
//             ]
//         ];

//         $audiences = Audience::where('validity', true)->pluck('name')->toArray();

//         Log::info("Success: surveyId=$surveyId, audienceType=$audienceType, department=$department, audiences=", $audiences);

//         return view('forms.survey-form', [
//             'surveyJson' => json_encode($surveyJson),
//             'survey_id' => $surveyId,
//             'questionaire' => (object) ['survey_id' => $surveyId, 'obfuscator' => 'initial-survey'],
//             'audiences' => $audiences,
//             'jurisdiction' => $audienceType
//         ]);
//     } catch (\Exception $e) {
//         Log::error("Error in getSurveyQuestions: " . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
//         return response()->json(['error' => 'Server error'], 500);
//     }
// }


    // public function fill(Request $request, $surveyId, $questionaireId)
    // {
    //     try {
    //         Log::info("Starting fill: surveyId={$surveyId}, questionaireId={$questionaireId}");
    //         Log::info('Request data:', $request->all());
    
    //         $survey = Survey::findOrFail($surveyId);
    //         $submission = SurveySubmission::create([
    //             'survey_id' => $surveyId,
    //             // 'user_id' => auth()->id(),
    //             'user_id' => auth()->id(),
    //             'submitted_at' => now(),
    //         ]);
    
    //         $answers = $request->except('_token');
    //         foreach ($answers as $key => $value) {
    //             if (preg_match('/question_(\d+)/', $key, $matches)) {
    //                 $questionId = $matches[1];
    //                 $answerValue = is_bool($value) ? ($value ? 'yes' : 'no') : $value;
    //                 Answer::create([
    //                     'question_id' => $questionId,
    //                     'survey_submission_id' => $submission->id,
    //                     'answer' => $answerValue,
    //                     'score' => $this->calculateScore($answerValue),
    //                 ]);
    //                 Log::info("Answer saved: questionId={$questionId}, value={$answerValue}, submission_id={$submission->id}");
    //             }
    //         }
    //         // return redirect()->route('survey.thankyou')->with('success', 'Survey submitted successfully');
    //         return view('forms.thank-you');
    //     } catch (\Exception $e) {
    //         Log::error("Error in fill: " . $e->getMessage());
    //         return redirect()->back()->with('error', 'Failed to submit survey');
    //     }
    // }
    // public function fill(Request $request, $surveyId, $questionaireId)
    // {
    //     try {
    //         // Log the start for debugging
    //         Log::info("Starting survey fill: surveyId={$surveyId}, questionaireId={$questionaireId}", $request->all());

    //         // Validate the survey exists
    //         $survey = Survey::findOrFail($surveyId);

    //         // Create a survey submission
    //         $submission = SurveySubmission::create([
    //             'survey_id' => $surveyId,
    //             'user_id' => auth()->id() ?? null, // Optional: link to authenticated user
    //             'submitted_at' => now(),
    //         ]);

    //         // Process answers
    //         $answers = $request->except('_token');
    //         foreach ($answers as $key => $value) {
    //             if (preg_match('/question_(\d+)/', $key, $matches)) {
    //                 $questionId = $matches[1];
    //                 // Convert boolean to a format your DB/back-office expects
    //                 $answerValue = is_bool($value) ? ($value ? 1 : 0) : $value;
    //                 Answer::create([
    //                     'question_id' => $questionId,
    //                     'survey_submission_id' => $submission->id,
    //                     'answer' => $answerValue,
    //                     'score' => $this->calculateScore($answerValue),
    //                 ]);
    //                 Log::info("Answer saved: questionId={$questionId}, value={$answerValue}, submission_id={$submission->id}");
    //             }
    //         }

    //         // Return a JSON response for the front-end (if using fetch)
    //         return response()->json(['success' => 'Survey submitted successfully'], 200);
    //         // Or redirect if using a form submission: return redirect()->route('survey.thankyou')->with('success', 'Survey submitted successfully');

    //     } catch (\Exception $e) {
    //         Log::error("Error in survey fill: " . $e->getMessage());
    //         return response()->json(['error' => 'Failed to submit survey'], 500);
    //         // Or redirect: return redirect()->back()->with('error', 'Failed to submit survey');
    //     }
    // }

    // public function fill(Request $request, $surveyId, $questionaireId)
    // {
    //     try {
    //         Log::info("Starting survey fill: surveyId={$surveyId}, questionaireId={$questionaireId}", $request->all());
    
    //         $survey = Survey::findOrFail($surveyId);
    //         $submission = SurveySubmission::create([
    //             'survey_id' => $surveyId,
    //             'user_id' => auth()->id() ?? null,
    //             'submitted_at' => now(),
    //         ]);
    
    //         $answers = $request->all(); // Use all() since fetch sends JSON
    //         Log::info("Raw answers data:", $answers);
            
    //         if (empty($answers)) {
    //             Log::warning("No answers provided in request");
    //         }
    
    //         foreach ($answers as $key => $value) {
    //             if (preg_match('/question_(\d+)/', $key, $matches)) {
    //                 $questionId = $matches[1];
    //                 if (!Question::where('id', $questionId)->exists()) {
    //                     Log::warning("Question ID {$questionId} does not exist");
    //                     continue;
    //                 }
    //                 $answerValue = is_bool($value) ? ($value ? 'yes' : 'no') : (string)$value;
    //                 $answer = Answer::create([
    //                     'question_id' => $questionId,
    //                     'survey_submission_id' => $submission->id,
    //                     'answer' => $answerValue,
    //                     'score' => $this->calculateScore($answerValue),
    //                 ]);
    //                 Log::info("Answer saved: questionId={$questionId}, value={$answerValue}, submission_id={$submission->id}");
    //             } else {
    //                 Log::warning("Key does not match question pattern: {$key}");
    //             }
    //         }
    
    //         return response()->json(['success' => 'Survey submitted successfully'], 200);
    //     } catch (\Exception $e) {
    //         Log::error("Error in survey fill: " . $e->getMessage() . "\n" . $e->getTraceAsString());
    //         return response()->json(['error' => 'Failed to submit survey: ' . $e->getMessage()], 500);
    //     }
    // }
    public function fill(Request $request, $surveyId, $questionaireId)
{
    try {
        Log::info("Starting survey fill: surveyId={$surveyId}, questionaireId={$questionaireId}");
        Log::info("Raw request data:", $request->all());
        Log::info("JSON decoded data:", $request->json()->all());

        $survey = Survey::findOrFail($surveyId);
        $submission = SurveySubmission::create([
            'survey_id' => $surveyId,
            'user_id' => auth()->id() ?? null,
            'submitted_at' => now(),
        ]);

        $answers = $request->json()->all(); // Use JSON decoding for fetch payloads
        Log::info("Answers to process:", $answers);

        if (empty($answers)) {
            Log::warning("No answers provided in request");
        }

        foreach ($answers as $key => $value) {
            if (preg_match('/question_(\d+)/', $key, $matches)) {
                $questionId = $matches[1];
                if (!Question::where('id', $questionId)->exists()) {
                    Log::warning("Question ID {$questionId} does not exist in questions table");
                    continue;
                }
                $answerValue = is_bool($value) ? ($value ? 'yes' : 'no') : (string)$value;
                $answer = Answer::create([
                    'question_id' => $questionId,
                    'survey_submission_id' => $submission->id,
                    'answer' => $answerValue,
                    'score' => $this->calculateScore($answerValue),
                ]);
                Log::info("Answer saved: questionId={$questionId}, value={$answerValue}, submission_id={$submission->id}");
            } else {
                Log::warning("Key does not match question pattern: {$key}");
            }
        }

        return response()->json(['success' => 'Survey submitted successfully'], 200);
    } catch (\Exception $e) {
        Log::error("Error in survey fill: " . $e->getMessage() . "\n" . $e->getTraceAsString());
        return response()->json(['error' => 'Failed to submit survey: ' . $e->getMessage()], 500);
    }
}

private function calculateScore($answer)
{
    if (is_numeric($answer)) {
        return (int)$answer;
    } elseif (is_string($answer)) {
        $lowerAnswer = strtolower($answer);
        return $lowerAnswer === 'yes' ? 1 : ($lowerAnswer === 'no' ? 0 : 0);
    }
    return 0;
}

    // private function calculateScore($answer)
    // {
    //     if (is_numeric($answer)) {
    //         return (int)$answer;
    //     }
    //     return 0; // Default score; adjust based on your needs
    // }
// }

//     private function calculateScore($answer)
// {
//     if (is_numeric($answer)) {
//         return (int)$answer;
//     } elseif (is_string($answer)) {
//         $lowerAnswer = strtolower($answer);
//         if ($lowerAnswer === 'yes') {
//             return 1;
//         } elseif ($lowerAnswer === 'no') {
//             return 0;
//         }
//     }
//     return 0; // Default score for unexpected input
// }

    public function create()
    {
        // return view('surveys.create');
        $audiences = Audience::where('validity', true)->get();
        return view('surveys.create', compact('audiences'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'string|required',
    //     ]);

    //     $audit_user_id = auth()->user()->id;

    //     AuditTrail::create([
    //         'user_id' => $audit_user_id,
    //         'controller' => 'SurveyController',
    //         'function' => 'store',
    //         'action' => 'Created a Survey',
    //     ]);

    //     $survey = new Survey;
    //     $survey->title = $request->input('title');
    //     $survey->obfuscator = Str::random(10);
    //     $survey->created_by = $audit_user_id;
    //     $survey->status = 'pending';
    //     $survey->audience_id = $request->input('audience_id');
    //     $survey->published = false;
    //     $survey->save();

    //     return redirect()->route('surveys.index')->with('success', 'Survey created as draft. Add at least 3 questions to publish.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required',
            'audience_ids' => 'required|array', // Expect an array of audience IDs
            'audience_ids.*' => 'exists:audiences,id', // Validate each ID
        ]);

        $audit_user_id = auth()->user()->id;

        AuditTrail::create([
            'user_id' => $audit_user_id,
            'controller' => 'SurveyController',
            'function' => 'store',
            'action' => 'Created a Survey',
        ]);

        $survey = new Survey;
        $survey->title = $request->input('title');
        $survey->department_id = $request->input('department_id');
        $survey->obfuscator = Str::random(10);
        $survey->created_by = $audit_user_id;
        $survey->status = 'pending';
        $survey->published = false;
        $survey->save();

        // Attach multiple audiences
        $survey->audiences()->attach($request->input('audience_ids'));

        return redirect()->route('surveys.index')->with('success', 'Survey created as draft. Add at least 3 questions to publish.');
    }

    public function show(Survey $survey)
    {
        return view('surveys.show', compact('survey'));
    }

    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        return view('surveys.edit', compact('survey'));
    }

    public function update(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);
        $audit_user_id = auth()->user()->id;

        $audit_trail = new AuditTrail;
        $audit_trail->user_id = $audit_user_id;
        $audit_trail->controller = 'SurveyController';
        $audit_trail->function = 'update';
        $audit_trail->action = 'update survey';
        $audit_trail->save();

        $survey->title = $request->input('title');
        $newStatus = $request->input('status');

        if ($newStatus === 'active') {
            $questionCount = Question::where('survey_id', $id)->count();
            if ($questionCount < 3) {
                return redirect()->back()->with('error', 'Survey must have at least 3 questions to be published.');
            }
            Survey::where('id', '!=', $id)->update(['status' => 'pending', 'published' => false]);
            $survey->status = 'active';
            $survey->published = true;
        } else {
            $survey->status = 'pending';
            $survey->published = false;
        }

        $survey->save();

        return redirect()->route('surveys.index')->with('success', 'Survey updated successfully.');
    }

    public function destroy(Survey $survey)
    {
        $audit_user_id = auth()->user()->id ?? null;

        AuditTrail::create([
            'user_id' => $audit_user_id,
            'controller' => 'SurveyController',
            'function' => 'destroy',
            'action' => 'Deleted a Survey',
        ]);

        $survey->delete();

        return redirect()->route('surveys.index')->with('success', 'Survey deleted successfully.');
    }

    public function checkPublished($surveyId)
    {
        $survey = Survey::findOrFail($surveyId);
        return response()->json(['published' => $survey->published]);
    }
}