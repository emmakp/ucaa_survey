<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use App\AuditTrail;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    //     $audit_action = 'View List of Departments';
    //     $audit_user_id = auth()->user()->id;

    //     // Audit this action
    //     $audit_trail = new AuditTrail();

    //     $audit_trail->action = $audit_action;
    //     $audit_trail->user_id = $audit_user_id;
    //     $audit_trail->controller = 'DepartmentsController';
    //     $audit_trail->function = 'index';

    //     $audit_trail->save();

    //     $departments = Departments::orderby('id', 'desc')->get();

    //     return view('departments.index')->with('departments', $departments);
    // }
    public function index()
    {
        $audit_action = 'View List of Departments';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        // $audit_trail = new AuditTrail();

        // $audit_trail->action = $audit_action;
        // $audit_trail->user_id = $audit_user_id;
        // $audit_trail->controller = 'DepartmentsController';
        // // $audit_trail->function = 'index';
        // $audit_trail->function = 'store';


        AuditTrail::create([
            'action' => $audit_action,
            'user_id' => $audit_user_id,
            'controller' => 'DepartmentsController',
            'function' => 'index',
        ]);


        // $audit_trail->save();

        // Use paginate instead of get
        $departments = Departments::orderBy('id', 'desc')->paginate(10); // 10 items per page

        return view('departments.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //in

        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    //     $audit_action = 'Add New Department';
    //     $audit_user_id = auth()->user()->id;

    //     // Audit this action
    //     $audit_trail = new AuditTrail();

    //     $audit_trail->action = $audit_action;
    //     $audit_trail->user_id = $audit_user_id;
    //     $audit_trail->controller = 'DepartmentsController';
    //     $audit_trail->function = 'store';

    //     $audit_trail->save();

    //     $this->validate($request, [
    //         'Name' => ['required', 'string', 'max:255', 'min:2'],
    //         'Description' => ['string', 'max:255', 'min:2', 'nullable'],
    //     ]);

    //     $department = new Departments;
        
    //     if ($request->input('Description') != '') {
    //         $department->Description = $request->input('Description');
    //     }

    //     $department->Name = $request->input('Name');
        
    //     $department->save();

    //     return redirect('/departments/create')->with('success', 'The record has been saved');
    // }
    public function store(Request $request)
    {
        $audit_action = 'Add New Department';
        $audit_user_id = auth()->user()->id;
    
        // Audit this action
        AuditTrail::create([
            'action' => $audit_action,
            'user_id' => $audit_user_id,
            'controller' => 'DepartmentsController',
            'function' => 'store',
        ]);
    
        $this->validate($request, [
            'Name' => ['required', 'string', 'max:255', 'min:2'],
            'Description' => ['string', 'max:255', 'min:2', 'nullable'],
        ]);
    
        $department = new Departments;
        if ($request->input('Description') != '') {
            $department->Description = $request->input('Description');
        }
        // $department->Name = $request->input('name'); // Map 'name' to 'Name'
        $department->Name = $request->input('Name'); // Map 'name' to 'Name'
        $department->Description = $request->input('Description', '');
        $department->is_active = $request->has('is_active') ? true : false;

        $department->save();
    
        return redirect('/departments/create')->with('success', 'The record has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    //     $audit_action = 'Deleted Department';
    //     $audit_user_id = auth()->user()->id;

    //     // Audit this action
    //     $audit_trail = new AuditTrail();

    //     $audit_trail->action = $audit_action;
    //     $audit_trail->user_id = $audit_user_id;

    //     $audit_trail->save();

    //     $department = Departments::find($id);

    //     $department->delete();

    //     return redirect('/departments')->with('error', 'Record has been deleted');
    // }
    public function destroy($id)
    {
        $audit_action = 'Deleted Department';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        AuditTrail::create([
            'action' => $audit_action,
            'user_id' => $audit_user_id,
            'controller' => 'DepartmentsController',
            'function' => 'destroy',
        ]);

        $department = Departments::find($id);
        $department->delete();

        return redirect('/departments')->with('error', 'Record has been deleted');
    }
}
