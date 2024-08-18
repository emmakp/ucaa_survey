<?php


namespace App\Http\Controllers;

use App\Question;
use App\Questionaire;
use App\QuestionType;
use Illuminate\Support\Str;
use App\AuditTrail;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        $questionaires = Questionaire::all();
        $questionTypes = QuestionType::all();
        return view('questions.create', compact('questionaires', 'questionTypes'));
    }

    public function store(Request $request)
    {
        // print_r($request->input());exit;
        $request->validate([
            'question' => 'required',
            'questionaire_id' => 'required|exists:questionaires,id',
            'question_type' => 'required|exists:question_types,id',
        ]);

        // Question::create($request->all());
        $question = new Question;
        $question->question = $request->input('question');
        $question->questionaire_id = $request->input('questionaire_id');
        $question->question_type = $request->input('question_type');
        $question->obfuscator = Str::random(10);
        $question->save();

        // return redirect()->route('questions.index')->with('success', 'Question created successfully.');
        return redirect()->back()->with('success', 'Question created successfully.');
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        $questionaires = Questionaire::all();
        $questionTypes = QuestionType::all();
        return view('questions.edit', compact('question', 'questionaires', 'questionTypes'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required',
            'questionaire_id' => 'required|exists:questionaires,id',
            'question_type' => 'required|exists:question_types,id',
        ]);

        $question->update($request->all());

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->back()->with('error', 'Question deleted successfully.');
    }
}
