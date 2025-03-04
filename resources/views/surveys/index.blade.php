@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-9">Surveys / Projects</h4>
                <div class="col-md-3"><a href="{{ route('surveys.create') }}" class="btn btn-success">Add new surveys</a></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-hover">
                @if (count($surveys) > 0)
                    <table class="table" id="datatablesSimple">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Audience</th>
                            <th>Status</th>
                            <th>Questionaires</th>
                            <th>Created By</th>
                            <th>Published</th>
                            <th>Actions</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($surveys as $record)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $record->title }}</td>
                                    <td>{{ $record->audiences->pluck('title')->implode(', ') ?: 'N/A' }}</td>
                                    <!-- <td><span class="badge bg-warning">{{ $record->status }}</span></td> -->
                                    <td>
                                        <span class="badge {{ $record->status === 'active' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $record->status }}
                                        </span>
                                    </td>
                                     <!-- //make the status class dynamic based on the status -->
                                    <!-- <td><span class="badge bg-{{ $record->status === 'Draft' ? 'warning' : ($record->status === 'active' ? 'success' : 'danger') }}">{{ $record->status }}</span></td> -->
                                    <td>{{ count($record->questionaires) }}</td>
                                    <td>{{ $record->user->FirstName }} {{ $record->user->SecondName }}</td>
                                    <td>{{ $record->published ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('surveys.edit', $record->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>{{ $record->created_at->setTimezone('Africa/Nairobi') }}</td>
                                </tr>
                                @php
                                    ++$counter;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No Survey Record in the System</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endsection