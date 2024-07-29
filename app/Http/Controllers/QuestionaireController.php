<?php

namespace App\Http\Controllers;

use App\Questionaire;
use App\Survey;
use App\Audience;
use Illuminate\Support\Str;
use App\AuditTrail;
use Illuminate\Http\Request;

class QuestionaireController extends Controller
{
    public function index()
    {
        $questionaires = Questionaire::orderBy('created_at', 'desc')->with(['survey','target_audience_rq','questions'])->get();
        // print_r($questionaires[0]->target_audience_rq);exit;
        return view('questionaires.index', compact('questionaires'));
    }

    public function create()
    {
        $surveys = Survey::orderBy('title')->get();
        $audiences = Audience::orderBy('title')->get();
        return view('questionaires.create')->with(['surveys' => $surveys, 'audiences' => $audiences]);
    }

    public function store(Request $request)
    {
        // print_r($request->input());exit;
        $request->validate([
            'survey_id' => 'required',
            'target_audience' => 'required',
        ]);

        $audit_action = 'Created an questionaire';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $questionaire = new Questionaire;
        $questionaire->survey_id = $request->input('survey_id');
        $questionaire->target_audience = $request->input('target_audience');
        $questionaire->validity = 1;
        $questionaire->obfuscator = Str::random(10);
        $questionaire->save();

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
