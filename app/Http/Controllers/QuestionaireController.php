<?php

namespace App\Http\Controllers;

use App\Questionaire;
use Illuminate\Http\Request;

class QuestionaireController extends Controller
{
    public function index()
    {
        $questionaires = Questionaire::all();
        return view('questionaires.index', compact('questionaires'));
    }

    public function create()
    {
        return view('questionaires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'obfuscator' => 'required',
            'survey_id' => 'required',
            'validity' => 'required|boolean',
            'target_audience' => 'required',
        ]);

        Questionaire::create($request->all());

        return redirect()->route('questionaires.index')->with('success', 'Questionaire created successfully.');
    }

    public function show(Questionaire $questionaire)
    {
        return view('questionaires.show', compact('questionaire'));
    }

    public function edit(Questionaire $questionaire)
    {
        return view('questionaires.edit', compact('questionaire'));
    }

    public function update(Request $request, Questionaire $questionaire)
    {
        $request->validate([
            'obfuscator' => 'required',
            'survey_id' => 'required',
            'validity' => 'required|boolean',
            'target_audience' => 'required',
        ]);

        $questionaire->update($request->all());

        return redirect()->route('questionaires.index')->with('success', 'Questionaire updated successfully.');
    }

    public function destroy(Questionaire $questionaire)
    {
        $questionaire->delete();

        return redirect()->route('questionaires.index')->with('success', 'Questionaire deleted successfully.');
    }
}
