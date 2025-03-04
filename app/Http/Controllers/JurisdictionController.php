<?php

namespace App\Http\Controllers;

use App\Jurisdiction;
use Illuminate\Http\Request;
use App\AuditTrail;

class JurisdictionController extends Controller
{
    public function index()
    {
        $jurisdictions = Jurisdiction::orderBy('name')->paginate(10);
        return view('jurisdictions.index', compact('jurisdictions'));
    }

    public function create()
    {
        return view('jurisdictions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jurisdictions,name',
            'is_active' => 'boolean', // Optional, defaults to true
        ]);

        $data = $request->all();
        $data['is_active'] = $request->input('is_active', true); // Default to true if not provided

        Jurisdiction::create($data);

        AuditTrail::create([
            'user_id' => auth()->id(),
            'controller' => 'JurisdictionController',
            'function' => 'store',
            'action' => "Created jurisdiction: {$request->name}",
        ]);

        return redirect()->route('jurisdictions.index')->with('success', 'Jurisdiction created successfully.');
    }

    public function edit(Jurisdiction $jurisdiction)
    {
        return view('jurisdictions.edit', compact('jurisdiction'));
    }

    public function update(Request $request, Jurisdiction $jurisdiction)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jurisdictions,name,' . $jurisdiction->id,
            'is_active' => 'boolean',
        ]);

        $jurisdiction->update($request->all());

        AuditTrail::create([
            'user_id' => auth()->id(),
            'controller' => 'JurisdictionController',
            'function' => 'update',
            'action' => "Updated jurisdiction: {$jurisdiction->name} to " . ($request->is_active ? 'active' : 'inactive'),
        ]);

        return redirect()->route('jurisdictions.index')->with('success', 'Jurisdiction updated successfully.');
    }

    public function destroy(Jurisdiction $jurisdiction)
    {
        $jurisdiction->delete();

        AuditTrail::create([
            'user_id' => auth()->id(),
            'controller' => 'JurisdictionController',
            'function' => 'destroy',
            'action' => "Deleted jurisdiction: {$jurisdiction->name}",
        ]);

        return redirect()->route('jurisdictions.index')->with('success', 'Jurisdiction deleted successfully.');
    }
}