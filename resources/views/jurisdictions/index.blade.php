@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <div class="row">
            <h4 class="col-md-9">Jurisdictions</h4>
            <div class="col-md-3">
                <a href="{{ route('jurisdictions.create') }}" class="btn btn-primary">Create Jurisdiction</a>
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
                @foreach ($jurisdictions as $jurisdiction)
                    <tr>
                        <td>{{ $jurisdiction->id }}</td>
                        <td>{{ $jurisdiction->name }}</td>
                        <td>{{ $jurisdiction->is_active ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('jurisdictions.edit', $jurisdiction->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('jurisdictions.destroy', $jurisdiction->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $jurisdictions->links() }}
        </div>
    </div>
</div>
@endsection