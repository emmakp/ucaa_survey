@extends('layouts.app')
@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-9">Questionaire</h4>
                <div class="col-md-3"><a href="{{ route('questionaires.create') }}" class="btn btn-success">Add new questionaire</a></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-hover">
                @if (count($questionaires) > 0)
                    <table class="table" id="datatablesSimple">
                        <thead>
                            <th>#</th>
                            <th>Unique ID</th>
                            <th>Survey</th>
                            <th>Target Audience</th>
                            <th>No. of Questions</th>
                            <th>Status</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($questionaires as $record)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    {{-- <td><a href="{{ route('surveys.show', ['questionaire' => $record->id]) }}" class="link">{{ $record->obfuscator }}</a></td> --}}
                                    <td><a href="/surveys/{{ $record->id }}" class="link">{{ $record->obfuscator }}  <i class="fa fa-link" aria-hidden="true" style="font-size: 10px"></i></a></td>
                                    <td>{{ $record->survey->title }}</td>
                                    <td>{{ $record->target_audience_rq->title }}</td>
                                    <td>{{ count($record->questions) }}</td>
                                    <td>@if ($record->validity === true) <span class="badge bg-success"> active @else <span class="badge bg-danger"> no active @endif</span></td>
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
                        <p>No Audience  Record in the System</p>
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

