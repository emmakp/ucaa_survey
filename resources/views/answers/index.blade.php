@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <h4>Survey Submissions</h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Survey Title</th>
                    <th>Audience</th> <!-- Added Audience column -->
                    <th>Department</th> <!-- Added Department column -->
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($submissions->isEmpty())
                    <tr>
                        <td colspan="6">No submissions found</td> <!-- Updated colspan from 4 to 6 -->
                    </tr>
                @else
                    @foreach ($submissions as $submission)
                        <tr>
                            <td>{{ $submission->id }}</td>
                            <td>{{ $submission->survey->title }}</td>
                            <td>{{ $submission->answers->first() ? (Str::title(str_replace('_', ' ', $submission->answers->first()->question->audience_type)) ?? 'N/A') : 'No Answers' }}</td>
                            <td>{{ $submission->answers->first() ? ($submission->answers->first()->question->department ?? 'N/A') : 'No Answers' }}</td>
                            <td>{{ $submission->submitted_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <a href="{{ route('answers.show', $submission->id) }}" class="btn btn-info">View Answers</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="mt-3">
            {{ $submissions->links('pagination::simple-bootstrap-4')  }}
        </div>
    </div>
</div>
@endsection


