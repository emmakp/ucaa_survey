
@extends('layouts.app')
@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-9">Questionaires</h4>
                <div class="col-md-3"><a href="{{ route('questionaires.create') }}" class="btn btn-success">Add New Questionnaire</a></div>
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
                            <th>Date</th>
                            <th>Actions</th>
                            <th>Action 2</th>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp
                            @foreach ($questionaires as $record)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td><a href="/questionaires/{{ $record->id }}" class="link">{{ $record->obfuscator }} <i class="fa fa-link" aria-hidden="true" style="font-size: 10px"></i></a></td>
                                    <td>{{ $record->survey->title }}</td>
                                    <td class="col-md-2">{{ $record->audience->title }}</td>
                                    <td>{{ $record->questions->count() }}</td>
                                    <td>{{ $record->created_at->setTimezone('Africa/Nairobi') }}</td>
                                    <td>
                                        <a href="{{ route('questionaires.edit', $record->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('questionaires.destroy', $record->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this questionnaire?')">Delete</button>
                                        </form>
                                    </td>
                                    <!-- <td><a href="{{ route('guest.form', ['survey_id' => $record->survey->obfuscator, 'questionaire_id' => $record->obfuscator]) }}">Get Link</a></td> -->
                                    <!-- <td>
    <a href="{{ route('guest.form', ['survey_id' => $record->survey->obfuscator, 'questionaire_id' => $record->obfuscator]) }}" 
       target="_blank" 
       class="btn btn-sm btn-info">Get Link</a>
</td> -->
<!-- <td>
    <a href="{{ route('guest.form', ['survey_id' => $record->survey->obfuscator, 'questionaire_id' => $record->obfuscator]) }}" 
       target="_blank" 
       class="">Get Link</a>
</td> -->
<td>
    <a href="{{ route('guest.form', [
        'survey_id' => $record->survey->obfuscator, 
        'questionaire_id' => $record->obfuscator, 
        'jurisdiction' => $record->survey->audiences()->where('validity', true)->first()->name ?? 'default_audience'
    ]) }}" 
       target="_blank" 
       class="">Get Link</a>
</td>
                                </tr>
                                @php $counter++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No Questionnaires in the System</p>
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