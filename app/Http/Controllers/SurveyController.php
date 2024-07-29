<?php

namespace App\Http\Controllers;

use App\Survey;
use App\AuditTrail;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $audit_action = 'View List of Surveys';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();



        $surveys = Survey::all();
        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'obfuscator' => 'required',
            'created_by' => 'required',
        ]);

        Survey::create($request->all());

        return redirect()->route('surveys.index')->with('success', 'Survey created successfully.');
    }

    public function show(Survey $survey)
    {
        return view('surveys.show', compact('survey'));
    }

    public function edit(Survey $survey)
    {
        return view('surveys.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'obfuscator' => 'required',
            'created_by' => 'required',
        ]);

        $survey->update($request->all());

        return redirect()->route('surveys.index')->with('success', 'Survey updated successfully.');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();

        return redirect()->route('surveys.index')->with('success', 'Survey deleted successfully.');
    }
}
