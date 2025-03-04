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
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <!-- <tbody>
                @foreach ($submissions as $submission)
                    <tr>
                        <td>{{ $submission->id }}</td>
                        <td>{{ $submission->survey->title }}</td>
                        <td>{{ $submission->submitted_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('answers.show', $submission->id) }}" class="btn btn-info">View Answers</a>
                        </td>
                    </tr>
                @endforeach
            </tbody> -->
            <tbody>
    @if ($submissions->isEmpty())
        <tr>
            <td colspan="4">No submissions found</td>
        </tr>
    @else
        @foreach ($submissions as $submission)
            <tr>
                <td>{{ $submission->id }}</td>
                <td>{{ $submission->survey->title }}</td>
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
            {{ $submissions->links() }}
        </div>
    </div>
</div>
@endsection