@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-10">Departments</h4>
                <a href="{{route('departments.create')}}" class="link">Add New Department</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-hover">
                @if (count($departments) > 0)
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date Added</th>
                            <th>#</th>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td> DEP-{{ $department->id }} </td>
                                    <td><a href="{{route('departments.show', ['department' => $department->id])}}" class="link">{{$department->Name }}</a></td>
                                    @if ($department->Description != '')
                                        <td>{{$department->Description }}</td>
                                        
                                    @else
                                        <td>None</td>
                                    @endif
                                    <td>{{$department->created_at }}</td>
                                    <td>
                                        <form action="{{ route('departments.destroy', ['department' => $department->id ]) }}" method="post">
                                            @csrf 
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No departments in the System</p>
                    </div>
                @endif
                {{-- {{ $departments->links() }} --}}
            </div>
        </div>
    </div>
@endsection