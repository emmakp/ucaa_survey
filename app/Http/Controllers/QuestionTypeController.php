<?php

namespace App\Http\Controllers;

use App\Models\QuestionType;
use Illuminate\Http\Request;

class QuestionTypeController extends Controller
{
    public function index()
    {
        $questionTypes = QuestionType::all();
        return view('question-types.index', compact('questionTypes'));
    }

    public function create()
    {
        return view('question-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'obfuscator' => 'required',
        ]);

        QuestionType::create($request->all());

        return redirect()->route('question-types.index')->with('success', 'Question type created successfully.');
    }

    public function show(QuestionType $questionType)
    {
        return view('question-types.show', compact('questionType'));
    }

    public function edit(QuestionType $questionType)
    {
        return view('question-types.edit', compact('questionType'));
    }

    public function update(Request $request, QuestionType $questionType)
    {
        $request->validate([
            'type' => 'required',
            'obfuscator' => 'required',
        ]);

        $questionType->update($request->all());

        return redirect()->route('question-types.index')->with('success', 'Question type updated successfully.');
    }

    public function destroy(QuestionType $questionType)
    {
        $questionType->delete();

        return redirect()->route('question-types.index')->with('success', 'Question type deleted successfully.');
    }
}
