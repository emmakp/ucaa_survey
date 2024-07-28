@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-10">Employees</h4>
                <a href="{{route('employees.create')}}" class="link">Add New Employee</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-hover">
                @if (count($employees) > 0)
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Title</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Phone Number</th>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td><a href="{{route('staff.show', ['staff' => $employee->id])}}" class="link">EMP-{{$employee->id }}</a></td>
                                    <td>{{$employee->user_title->TitleName }}</td>
                                    <td>{{$employee->FirstName}}</td>
                                    <td>{{$employee->LastName }}</td>
                                    <td>{{$employee->Email }}</td>
                                    <td>{{$employee->department->Name }}</td>
                                    <td>0{{$employee->PhoneNumber }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No employees in the System</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection