<?php

namespace App\Http\Controllers;

use App\Audience;
use App\AuditTrail;
use Illuminate\Http\Request;

class AudienceController extends Controller
{
    public function index()
    {
        $audit_action = 'View List of Audiences';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();



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
            'created_by' => 'required',
            'obfuscator' => 'required',
            'validity' => 'required|boolean',
        ]);

        Audience::create($request->all());

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
