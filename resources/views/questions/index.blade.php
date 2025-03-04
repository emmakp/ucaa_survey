@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <div class="row">
            <h4 class="col-md-9">Questions</h4>
            <div class="col-md-3"><a href="{{ route('questions.create') }}" class="btn btn-primary">Create Question</a></div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Questionnaire ID</th>
                    <th>Question Type</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->questionaire->obfuscator }}</td>
                        <td>{{ $question->question_type }}</td>
                        <td>{{ $question->department }}</td>
                        <td>
                            <a href="{{ route('questionaires.show', $question->questionaire_id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add Pagination Links -->
        <!-- <div class="mt-3">
            {{ $questions->links() }}
        </div> -->
        <div class="mt-3">
    {{ $questions->links('pagination::simple-bootstrap-4') }}
</div>
    </div>
</div>
@endsection