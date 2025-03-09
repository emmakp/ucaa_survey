@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <h4>Answers for Submission #{{ $submission->id }} ({{ $submission->survey ? $submission->survey->title : 'No Survey Title' }})</h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($answers as $answer)
                    <tr>
                        <td>{{ $answer->question ? $answer->question->question : 'Unknown Question' }}</td>
                        <td>{{ $answer->answer }}</td>
                        <td>{{ $answer->score ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No answers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('answers.index') }}" class="btn btn-secondary">Back to Submissions</a>
    </div>
</div>
@endsection