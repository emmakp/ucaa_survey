@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <div class="row">
            <h4 class="col-md-9">Create Questionaire</h4>
            <div class="col-md-3"><a href="{{ route('audiences.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Back</a></div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('questionaires.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="survey_id">Survey</label>
                <select name="survey_id" id="survey_id" class="form-control" required>
                    <option value="#" disabled selected>-- Select option --</option>
                    @foreach ($surveys as $survey)
                        <option value="{{ $survey->id }}">{{ $survey->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="target_audience">Target Audience</label>
                <select name="target_audience" id="target_audience" class="form-control" required>
                    <option value="#" disabled selected>-- Select option --</option>
                    @foreach ($audiences as $audience)
                        <option value="{{ $audience->id }}">{{ $audience->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection
