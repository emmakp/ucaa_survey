@extends('layouts.app')

@section('content')
    <h1>Edit Question</h1>
    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" id="question" class="form-control" value="{{ $question->question }}" required>
        </div>
        <div class="form-group">
            <label for="questionaire_id">Questionnaire</label>
            <select name="questionaire_id" id="questionaire_id" class="form-control" required>
                @foreach ($questionaires as $questionaire)
                    <option value="{{ $questionaire->id }}" {{ $questionaire->id == $question->questionaire_id ? 'selected' : '' }}>
                        {{ $questionaire->obfuscator }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="question_type">Question Type</label>
            <select name="question_type" id="question_type" class="form-control" required>
                @foreach ($questionTypes as $questionType)
                    <option value="{{ $questionType->id }}" {{ $questionType->id == $question->question_type ? 'selected' : '' }}>
                        {{ $questionType->type }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
