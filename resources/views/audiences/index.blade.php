@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-9">Audiences</h4>
                <div class="col-md-3"><a href="{{ route('audiences.create') }}" class="btn btn-success">Add new audiance</a></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-hover">
                @if (count($audiences) > 0)
                    <table class="table" id="datatablesSimple">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($audiences as $record)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $record->title }}</td>
                                    <td>{{ $record->user->FirstName }} {{ $record->user->SecondName }}</td>
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
