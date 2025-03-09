<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\SurveySubmission;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        $submissions = SurveySubmission::with('survey')->orderBy('submitted_at', 'desc')->paginate(10); // Paginate submissions, 10 per page
        return view('answers.index', compact('submissions'));
    }

    // public function show(SurveySubmission $submission)
    // {
    //     $submission->load('survey'); // Eager-load survey
    //     $answers = Answer::where('survey_submission_id', $submission->id)->with('question')->get();
    //     return view('answers.show', compact('submission', 'answers'));
    // }
//     public function show(SurveySubmission $submission)
// {
//     $answers = $submission->answers; // Assumes a hasMany relationship
//     return view('answers.show', compact('submission', 'answers'));
// }
public function show(SurveySubmission $submission)
{
    $answers = $submission->answers()->with('question')->get(); // Explicitly fetch with question
    // dd([
    //     'submission_id' => $submission->id,
    //     'survey' => $submission->survey ? $submission->survey->title : 'No Survey',
    //     'answers_count' => $answers->count(),
    //     'answers' => $answers->toArray(),
    // ]);
    return view('answers.show', compact('submission', 'answers'));
}

    public function create()
    {
        $questions = Question::all();
        return view('answers.create', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'score' => 'required|integer',
            'question_id' => 'required|exists:questions,id',
        ]);

        Answer::create($request->all());

        return redirect()->route('answers.index')->with('success', 'Answer created successfully.');
    }

    public function edit(Answer $answer)
    {
        $questions = Question::all();
        return view('answers.edit', compact('answer', 'questions'));
    }

    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'answer' => 'required',
            'score' => 'required|integer',
            'question_id' => 'required|exists:questions,id',
        ]);

        $answer->update($request->all());

        return redirect()->route('answers.index')->with('success', 'Answer updated successfully.');
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();

        return redirect()->route('answers.index')->with('success', 'Answer deleted successfully.');
    }
}