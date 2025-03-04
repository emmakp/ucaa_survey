@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h4>Create Question</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('questions.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="question">Question</label>
                    <input type="text" name="question" id="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question') }}" required>
                    @error('question')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="questionaire_id">Questionnaire</label>
                    <select name="questionaire_id" id="questionaire_id" class="form-control @error('questionaire_id') is-invalid @enderror" required>
                        @foreach (\App\Questionaire::all() as $questionaire)
                            <option value="{{ $questionaire->id }}" {{ old('questionaire_id') == $questionaire->id ? 'selected' : '' }}>{{ $questionaire->obfuscator }}</option>
                        @endforeach
                    </select>
                    @error('questionaire_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="question_type">Question Type</label>
                    <select name="question_type" id="question_type" class="form-control @error('question_type') is-invalid @enderror" required>
                        @foreach (\App\QuestionType::all() as $type)
                            <option value="{{ $type->id }}" {{ old('question_type') == $type->id ? 'selected' : '' }}>{{ $type->type }}</option>
                        @endforeach
                    </select>
                    @error('question_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="department">Department</label>
                    <select name="department" id="department" class="form-control @error('department') is-invalid @enderror" required>
                        <option value="Security" {{ old('department') == 'Security' ? 'selected' : '' }}>Security</option>
                        <option value="Operations" {{ old('department') == 'Operations' ? 'selected' : '' }}>Operations</option>
                        <option value="Customs and Immigrations" {{ old('department') == 'Customs and Immigrations' ? 'selected' : '' }}>Customs and Immigrations</option>
                        <option value="Strategic Planning" {{ old('department') == 'Strategic Planning' ? 'selected' : '' }}>Strategic Planning</option>
                        <option value="Information Desk" {{ old('department') == 'Information Desk' ? 'selected' : '' }}>Information Desk</option>
                        <option value="General" {{ old('department') == 'General' ? 'selected' : '' }}>General</option>
                    </select>
                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Question</button>
                <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
