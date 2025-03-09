@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h4>Manage Questionnaires for {{ $survey->title }}</h4>
            <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-secondary float-end">Back to Edit Survey</a>
        </div>
        <div class="card-body">
            @if ($questionaires->isEmpty())
                <p>No questionnaires found for this survey.</p>
                <a href="{{ route('questionaires.create') }}?survey_id={{ $survey->id }}" class="btn btn-success">Add New Questionnaire</a>
            @else
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Unique ID</th>
                        <th>Target Audience</th>
                        <th>Questions</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($questionaires as $index => $questionaire)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $questionaire->obfuscator }}</td>
                                <td>{{ $questionaire->audience->title }}</td>
                                <td>{{ $questionaire->questions->count() }}</td>
                                <td>
                                    <a href="{{ route('questionaires.edit', $questionaire->id) }}" class="btn btn-sm btn-primary">Manage Questions</a>
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