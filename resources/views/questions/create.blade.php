@extends('layouts.app')

@section('content')
    <h1>Create Question</h1>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" id="question" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="questionaire_id">Questionnaire</label>
            <select name="questionaire_id" id="questionaire_id" class="form-control" required>
                @foreach ($questionaires as $questionaire)
                    <option value="{{ $questionaire->id }}">{{ $questionaire->obfuscator }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="question_type">Question Type</label>
            <select name="question_type" id="question_type" class="form-control" required>
                @foreach ($questionTypes as $questionType)
                    <option value="{{ $questionType->id }}">{{ $questionType->type }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
