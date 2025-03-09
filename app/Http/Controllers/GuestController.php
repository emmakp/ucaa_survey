<?php

// namespace App\Http\Controllers;

// use App\Question;      // Assuming app/Question.php
// use App\Answer;        // Switch to Answers model, assuming app/Answer.php
// use App\Questionaire;  // Corrected from App\Models\Questionaire
// use Illuminate\Http\Request;

// class GuestController extends Controller
// {
//     public function get_form($survey_id, $questionaire_id, $jurisdiction)
//     {
//         return view('forms.survey-form', compact('survey_id', 'questionaire_id', 'jurisdiction'));
//     }

//     public function post_form(Request $request, $survey_id, $questionaire_id)
//     {
//         try {
//             \Log::info("Starting post_form: survey_id={$survey_id}, questionaire_id={$questionaire_id}");
//             \Log::info("Request data: " . json_encode($request->all()));

//             // Find the Questionaire by obfuscator to get its ID
//             $questionaire = Questionaire::where('obfuscator', $questionaire_id)->firstOrFail();
//             $questionaireId = $questionaire->id;
//             \Log::info("Questionaire found: id={$questionaireId}");

//             // Create a new Answer instance (instead of Response)
//             $answer = new Answer();
//             $answer->survey_id = $survey_id;
//             $answer->questionaire_id = $questionaireId;
//             $answer->question_id = $request->input('question_id', 1); // Default to 1 if not provided
//             $answer->response = json_encode($request->all());
//             $answer->audience_type = $request->input('jurisdiction');
//             $answer->submitted_at = now();
//             $answer->save();

//             \Log::info("Answer saved: id={$answer->id}");
//             return redirect()->route('survey.thank-you');
//         } catch (\Exception $e) {
//             \Log::error("Error in post_form: " . $e->getMessage() . "\n" . $e->getTraceAsString());
//             return redirect()->route('survey.staff', ['survey_id' => $survey_id, 'questionaire_id' => $questionaire_id])
//                             ->with('error', 'Failed to save response: ' . $e->getMessage());
//         }
//     }
// }










namespace App\Http\Controllers;

use App\Answer;
use App\Questionaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    // public function post_form(Request $request, $survey_id, $questionaire_id)
    //     try {
    //         Log::info("Starting post_form: survey_id={$survey_id}, questionaire_id={$questionaire_id}");
    //         Log::info("Request data: " . json_encode($request->all()));

    //         // Loop through form inputs (e.g., question_1, question_2)
    //         foreach ($request->all() as $key => $value) {
    //             if (strpos($key, 'question_') === 0) {
    //                 $questionId = str_replace('question_', '', $key);
    //                 $answer = new Answer();
    //                 $answer->question_id = $questionId;
    //                 $answer->answer = $value;
    //                 $answer->score = 0; // Adjust if you calculate scores
    //                 $answer->save();
    //                 Log::info("Answer saved for question {$questionId}: answer={$value}");
    //             }
    //         }

    //         return redirect()->route('survey.thank-you');
    //     } catch (\Exception $e) {
    //         Log::error("Error in post_form: " . $e->getMessage() . "\n" . $e->getTraceAsString());
    //         return redirect()->route('survey.staff', ['survey_id' => $survey_id, 'questionaire_id' => $questionaire_id])
    //                         ->with('error', 'Failed to save response: ' . $e->getMessage());
    //     }
    // }

    public function post_form(Request $request, $survey_id, $questionaire_id)
    {
        try {
            Log::info("Starting post_form: survey_id={$survey_id}, questionaire_id={$questionaire_id}");
            Log::info("Request data: " . json_encode($request->all()));
    
            // Verify the questionnaire exists
            $questionaire = Questionaire::where('obfuscator', $questionaire_id)->firstOrFail();
            $questionaireId = $questionaire->id;
            Log::info("Questionaire found: id={$questionaireId}");
    
            // Save each answer (assuming form fields like 'question_1', 'question_2', etc.)
            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'question_') === 0) {
                    $questionId = str_replace('question_', '', $key);
                    $answer = new Answer();
                    $answer->question_id = $questionId;
                    $answer->answer = $value;
                    $answer->score = 0; // Set a default or calculate if needed
                    $answer->save();
                    Log::info("Answer saved for question {$questionId}: answer={$value}");
                }
            }
    
            // return redirect()->route('survey.thank-you');
            return view('forms.thank-you');
        } catch (\Exception $e) {
            Log::error("Error in post_form: " . $e->getMessage());
            return redirect()->route('survey.staff', ['survey_id' => $survey_id, 'questionaire_id' => $questionaire_id])
                           ->with('error', 'Failed to save response');
        }
    }
}




// namespace App\Http\Controllers;

// use App\Answer;
// use App\Questionaire;
// use App\SurveySubmission;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

// class GuestController extends Controller
// {
//     public function post_form($survey_id, $questionaire_id, Request $request)
//     {
//         Log::info("Starting post_form: survey_id={$survey_id}, questionaire_id={$questionaire_id}");
//         Log::info('Request data:', $request->all());

//         $questionaire = Questionaire::where('obfuscator', $questionaire_id)->first();
//         if (!$questionaire) {
//             Log::error('Questionaire not found');
//             return redirect()->back()->with('error', 'Invalid questionnaire');
//         }
//         Log::info('Questionaire found: id=' . $questionaire->id);

//         // Create a new survey submission
//         $submission = SurveySubmission::create([
//             'survey_id' => $survey_id,
//             'user_id' => auth()->id(), // Null if guest
//             'submitted_at' => now(),
//         ]);

//         foreach ($request->except('_token') as $key => $value) {
//             if (preg_match('/question_(\d+)/', $key, $matches)) {
//                 $questionId = $matches[1];
//                 $answerValue = $value === true ? 1 : ($value === false ? '' : $value);
//                 $answer = Answer::create([
//                     'question_id' => $questionId,
//                     'survey_submission_id' => $submission->id,
//                     'answer' => $answerValue,
//                     'score' => is_numeric($answerValue) ? (int)$answerValue : 0,
//                 ]);
//                 Log::info("Answer saved for question {$questionId}: answer={$answerValue}, submission_id={$submission->id}");
//             } else {
//                 Log::warning("Invalid key format: {$key}");
//             }
//         }

//         return redirect()->route('survey.thankyou')->with('success', 'Survey submitted successfully');
//         // return view('forms.thank-you');
//     }

//     // Assuming get_form exists for rendering the survey form
//     public function get_form($survey_id, $questionaire_id, $jurisdiction)
//     {
//         // Delegate to SurveyController for consistency
//         return app()->make('App\Http\Controllers\SurveyController')
//             ->getSurveyQuestions($survey_id, $jurisdiction, 'Security'); // Adjust department as needed
//     }
// }