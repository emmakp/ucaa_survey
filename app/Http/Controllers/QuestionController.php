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
        $questions = Question::with('questionaire')->paginate(5); // Paginate with 5 per page
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
        $request->validate([
            'question' => 'required|string|max:255',
            'questionaire_id' => 'required|exists:questionaires,id',
            'question_type' => 'required|exists:question_types,id',
            'department' => 'required|string|max:255',
        ]);

        $question = Question::create([
            'question' => $request->question,
            'questionaire_id' => $request->questionaire_id,
            'question_type' => $request->question_type,
            'department' => $request->department,
            'survey_id' => Questionaire::find($request->questionaire_id)->survey_id, // Linked to survey
            'audience_type' => 'passenger', // Default value
            'is_required' => true, // Default value
            'obfuscator' => Str::random(10),
            'validity' => true,
        ]);

        // Optionally audit this action
        AuditTrail::create([
            'user_id' => auth()->user()->id ?? null,
            'controller' => 'QuestionController',
            'function' => 'store',
            'action' => 'Created a Question',
        ]);

        return redirect()->route('questions.index')->with('success', 'Question created successfully.');
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
            'question' => 'required|string|max:255',
            'questionaire_id' => 'required|exists:questionaires,id',
            'question_type' => 'required|exists:question_types,id',
            'department' => 'required|string|max:255', // Add department validation
        ]);

        $question->update([
            'question' => $request->question,
            'questionaire_id' => $request->questionaire_id,
            'question_type' => $request->question_type,
            'department' => $request->department,
        ]);

        // Optionally audit this action
        AuditTrail::create([
            'user_id' => auth()->user()->id ?? null,
            'controller' => 'QuestionController',
            'function' => 'update',
            'action' => 'Updated a Question',
        ]);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        // Optionally audit this action
        AuditTrail::create([
            'user_id' => auth()->user()->id ?? null,
            'controller' => 'QuestionController',
            'function' => 'destroy',
            'action' => 'Deleted a Question',
        ]);

        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}