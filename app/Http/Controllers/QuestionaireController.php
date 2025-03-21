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

    // public function store(Request $request)
    // {
    //     // print_r($request->input());exit;
    //     $request->validate([
    //         'survey_id' => 'required',
    //         'target_audience' => 'required',
    //     ]);

    //     $audit_action = 'Created an questionaire';
    //     $audit_user_id = auth()->user()->id;

    //     // Audit this action
    //     $audit_trail = new AuditTrail();

    //     $audit_trail->action = $audit_action;
    //     $audit_trail->user_id = $audit_user_id;

    //     $audit_trail->save();

    //     $questionaire = new Questionaire;
    //     $questionaire->survey_id = $request->input('survey_id');
    //     $questionaire->target_audience = $request->input('target_audience');
    //     $questionaire->validity = 1;
    //     $questionaire->obfuscator = Str::random(10);
    //     $questionaire->save();

    //     return redirect()->route('questionaires.index')->with('success', 'Questionaire created successfully.');
    // }

//     public function store(Request $request)
// {
//     $request->validate([
//         'obfuscator' => 'required|string|max:255',
//         'survey_id' => 'required|exists:surveys,id',
//         'validity' => 'required|boolean',
//         'target_audience' => 'required|integer',
//     ]);

//     $audit_user_id = auth()->user()->id;
//     AuditTrail::create([
//         'user_id' => $audit_user_id,
//         'controller' => 'QuestionaireController', // Add required field
//         'function' => 'store', // Add if function exists in schema
//         'action' => 'Created a questionnaire', // Fixed typo
//     ]);

//     $questionaire = Questionaire::create($request->all());

//     return redirect()->route('questionaires.index')->with('success', 'Questionnaire created successfully.');
// }
public function store(Request $request)
{
    // Validate only the fields from the form
    $request->validate([
        'survey_id' => 'required|exists:surveys,id',
        'target_audience' => 'required|integer',
    ]);

    $audit_user_id = auth()->user()->id;
    AuditTrail::create([
        'user_id' => $audit_user_id,
        'controller' => 'QuestionaireController',
        'function' => 'store',
        'action' => 'Created a questionnaire',
    ]);

    // Merge validated data with auto-generated fields
    $data = $request->all();
    $data['obfuscator'] = Str::random(10); // Auto-generate obfuscator
    $data['validity'] = 1; // Default to true

    $questionaire = Questionaire::create($data);

    return redirect()->route('questionaires.index')->with('success', 'Questionnaire created successfully.');
}

    public function show(Questionaire $questionaire)
    {
        return view('questionaires.show', compact('questionaire'));
    }

    // public function edit(Questionaire $questionaire)
    // {
    //     return view('questionaires.edit', compact('questionaire'));
    // }

    // public function update(Request $request, Questionaire $questionaire)
    // {
    //     $request->validate([
    //         'obfuscator' => 'required',
    //         'survey_id' => 'required',
    //         'validity' => 'required|boolean',
    //         'target_audience' => 'required',
    //     ]);

    //     $questionaire->update($request->all());

    //     return redirect()->route('questionaires.index')->with('success', 'Questionaire updated successfully.');
    // }

    // public function destroy(Questionaire $questionaire)
    // {
    //     $questionaire->delete();

    //     return redirect()->back()->with('error', 'Questionaire deleted successfully.');
    // }
    public function edit($id)
{
    $questionaire = Questionaire::with(['survey', 'audience', 'questions'])->findOrFail($id);
    $surveys = Survey::all();
    $audiences = Audience::where('validity', true)->get();
    return view('questionaires.edit', compact('questionaire', 'surveys', 'audiences'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'survey_id' => 'required|exists:surveys,id',
        'target_audience' => 'required|exists:audiences,id',
        'validity' => 'boolean',
    ]);

    $questionaire = Questionaire::findOrFail($id);
    $questionaire->survey_id = $request->input('survey_id');
    $questionaire->target_audience = $request->input('target_audience');
    $questionaire->validity = $request->has('validity') ? true : false;
    $questionaire->save();

    return redirect()->route('questionaires.index')->with('success', 'Questionnaire updated successfully');
}

public function destroy($id)
{
    $questionaire = Questionaire::findOrFail($id);
    $questionaire->delete();
    return redirect()->route('questionaires.index')->with('success', 'Questionnaire deleted successfully');
}
}
