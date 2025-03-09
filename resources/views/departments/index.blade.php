@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <div class="row">
            <h4 class="col-md-9">Departments</h4>
            <div class="col-md-3">
                <a href="{{ route('departments.create') }}" class="btn btn-primary">Create Department</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->Name }}</td>
                        <td>{{ $department->is_active ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No departments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $departments->links() }}
        </div>
    </div>
</div>
@endsection