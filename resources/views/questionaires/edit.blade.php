@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <!-- <h4>Edit Questionnaire: {{ $questionaire->obfuscator }}</h4> -->
            <h4>Edit Questionnaire: {{  $questionaire->audience->title }}</h4>

            <a href="{{ route('questionaires.index') }}" class="btn btn-secondary float-end">Back</a>
        </div>
        <div class="card-body">
            <!-- Update Form -->
            <form method="POST" action="{{ route('questionaires.update', $questionaire->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="survey_id">Survey</label>
                    <select name="survey_id" id="survey_id" class="form-control" required>
                        @foreach ($surveys as $survey)
                            <option value="{{ $survey->id }}" {{ $survey->id == $questionaire->survey_id ? 'selected' : '' }}>
                                {{ $survey->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="target_audience">Target Audience</label>
                    <select name="target_audience" id="target_audience" class="form-control" required>
                        @foreach ($audiences as $audience)
                            <option value="{{ $audience->id }}" {{ $audience->id == $questionaire->target_audience ? 'selected' : '' }}>
                                {{ $audience->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="validity">Active</label>
                    <input type="checkbox" name="validity" id="validity" value="1" {{ $questionaire->validity ? 'checked' : '' }}>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

            <!-- Questions List -->
            <h5 class="mt-4">Questions ({{ $questionaire->questions->count() }})</h5>
            @if ($questionaire->questions->isEmpty())
                <p>No questions assigned to this questionnaire.</p>
                <a href="{{ route('questions.create') }}?questionaire_id={{ $questionaire->id }}" class="btn btn-success">Add New Question</a>
            @else
                <table class="table mt-3">
                    <thead>
                        <th>#</th>
                        <th>Question</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($questionaire->questions as $index => $question)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->department }}</td>
                                <td>{{ $question->questionType->type }}</td>
                                <td>
                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection