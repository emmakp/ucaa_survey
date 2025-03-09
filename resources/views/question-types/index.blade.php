@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Question Types</div>
    <div class="card-body">
        <a href="{{ route('question-type.create') }}" class="btn btn-primary mb-3">Create New Question Type</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Obfuscator</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questionTypes as $questionType)
                <tr>
                    <td>{{ $questionType->id }}</td>
                    <td>{{ $questionType->type }}</td>
                    <td>{{ $questionType->obfuscator }}</td>
                    <td>
                        <a href="{{ route('question-type.edit', $questionType->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('question-type.destroy', $questionType->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection