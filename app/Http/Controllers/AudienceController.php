<?php

namespace App\Http\Controllers;

use App\Audience;
use App\AuditTrail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AudienceController extends Controller
{
    public function index()
    {
        $audit_action = 'View List of Audiences';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        // $audit_trail = new AuditTrail();

        AuditTrail::create([
            'user_id' => $audit_user_id,
            'controller' => 'SurveyController',
            'function' => 'index',
            'action' => 'View List of Surveys',
        ]);

        // $audit_trail->action = $audit_action;
        // $audit_trail->user_id = $audit_user_id;

        // $audit_trail->save();



        $audiences = Audience::all();
        return view('audiences.index', compact('audiences'));
    }

    public function create()
    {
        return view('audiences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'created_by' => 'required',
            // 'obfuscator' => 'required',
            // 'validity' => 'required|boolean',
        ]);

        $audit_action = 'Created an audience';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        // Audience::create($request->all());
        $audience = new Audience;
        $audience->title = $request->input('title');
        $audience->obfuscator = Str::random(10);
        $audience->created_by = $audit_user_id;
        $audience->validity = 1;
        $audience->save();

        return redirect()->route('audiences.index')->with('success', 'Audience created successfully.');
    }

    public function show(Audience $audience)
    {
        return view('audiences.show', compact('audience'));
    }

    public function edit(Audience $audience)
    {
        return view('audiences.edit', compact('audience'));
    }

    public function update(Request $request, Audience $audience)
    {
        $request->validate([
            'title' => 'required',
            'created_by' => 'required',
            'obfuscator' => 'required',
            'validity' => 'required|boolean',
        ]);

        $audience->update($request->all());

        return redirect()->route('audiences.index')->with('success', 'Audience updated successfully.');
    }

    public function destroy(Audience $audience)
    {
        $audience->delete();

        return redirect()->route('audiences.index')->with('success', 'Audience deleted successfully.');
    }
}
