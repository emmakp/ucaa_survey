@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <div class="row">
            <h4 class="col-md-9">Create Question</h4>
            <div class="col-md-3"><a href="{{ route('questions.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Back</a></div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('questions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" name="question" id="question" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="questionaire_id">Questionnaire</label>
                <select name="questionaire_id" id="questionaire_id" class="form-control" required>
                    <option value="#" disabled selected>-- select option --</option>
                    @foreach ($questionaires as $questionaire)
                        <option value="{{ $questionaire->id }}">{{ $questionaire->obfuscator }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="question_type">Question Type</label>
                <select name="question_type" id="question_type" class="form-control" required>
                    <option value="#" disabled selected>-- select option --</option>
                    @foreach ($questionTypes as $questionType)
                        <option value="{{ $questionType->id }}">{{ $questionType->type }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection
