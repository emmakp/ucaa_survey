<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use App\Titles;
use App\Departments;
use App\AuditTrail;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $audit_action = 'View List of Employees';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $employees = Employees::orderby('id', 'desc')->with(['department', 'user_title'])->get();

        // print_r($employees); exit;
        return view('employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $titles = Titles::orderby('id','desc')->get();
        $departments = Departments::orderby('id','desc')->get();

        return view('employees.create')->with(['titles' => $titles, 'departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $audit_action = 'Added New Employee';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $this->validate($request, [
            'FirstName' => ['required', 'string', 'max:255'],
            'SecondName' => ['required', 'string', 'max:255'],
            'department' => ['required', 'integer'],
            'gender' => ['required', 'string'],
            'PhoneNumber' => ['required', 'unique:employees', 'digits:9'],
        ]);

        $titleID = $request->input('title');
        if($titleID === 'N'){
            // echo 'is char ';
            $this->validate($request, [
                'newtitle' => ['required', 'string', 'min:2'],
                'newtitleacrynom' => ['required', 'string'],
            ]);

            $title = new Titles;
            $title->TitleName = $request->input('newtitle');
            $title->Acrynom = $request->input('newtitleacrynom');
            $title->save();

            $titleID = $title->id;
        }
        else{
            $this->validate($request, [
                'title' => ['required', 'integer'],
            ]);
        }

        // print_r($request->input()); exit;
        $employee = new Employees;

        if ($request->input('email') != $employee->email) {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            ]);
            $employee->email = $request->input('email');
        }

        $employee->FirstName = $request->input('FirstName');
        $employee->LastName = $request->input('SecondName');
        $employee->DepartmentID = $request->input('department');
        $employee->TitleID = $titleID;
        $employee->PhoneNumber = $request->input('PhoneNumber');
        $employee->gender = $request->input('gender');

        $employee->save();

            return redirect('/employees/create')->with('success', 'Employee Details have been saved');
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
    public function destroy($id)
    {
        //
        $audit_action = 'Delete Employee Record';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $employee = Employees::find($id);

        $employee->delete();

        return redirect('/employees')->with('error', 'Record has been deleted');
    }
}
