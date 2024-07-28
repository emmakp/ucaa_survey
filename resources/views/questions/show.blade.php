@extends('layouts.app')

@section('content')
    <h1>Question Details</h1>
    <p><strong>ID:</strong> {{ $question->id }}</p>
    <p><strong>Question:</strong> {{ $question->question }}</p>
    <p><strong>Questionnaire ID:</strong> {{ $question->questionaire_id }}</p>
    <p><strong>Question Type:</strong> {{ $question->question_type }}</p>
    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
