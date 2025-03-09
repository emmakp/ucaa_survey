<?php

namespace App\Http\Controllers;

use App\Survey;
use App\AuditTrail;
use App\Departments;
use App\Audience;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $departments = Departments::orderBy('Name', 'ASC')->get();
        // $audiences = Audience::orderBy('title')->get();
        
        return view('surveys.create')->with(['departments' => $departments]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required',
            'department_id' => 'integer|required',
        ]);


        $audit_action = 'Created a Survey';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        // Survey::create($request->all());
        $survey = new Survey;
        $survey->title = $request->input('title');
        $survey->department_id = $request->input('department_id');
        $survey->obfuscator = Str::random(10);
        $survey->created_by = $audit_user_id;
        $survey->status = 'pending';
        $survey->save();



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
            'department_id' => 'required',
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
