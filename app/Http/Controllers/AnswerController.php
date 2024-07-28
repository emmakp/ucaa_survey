<?php


namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        $answers = Answer::all();
        return view('answers.index', compact('answers'));
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

    public function show(Answer $answer)
    {
        return view('answers.show', compact('answer'));
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
