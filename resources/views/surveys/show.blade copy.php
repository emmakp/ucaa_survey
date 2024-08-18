@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Question Details</h1>
    <p><strong>ID:</strong> {{ $survey->obfuscator }}</p>
    {{-- <p><strong>Questions:</strong> {{ $question->question }}</p>
    <p><strong>Questionnaire ID:</strong> {{ $question->questionaire_id }}</p>
    <p><strong>Question Type:</strong> {{ $question->question_type }}</p>
    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to List</a> --}}

    <h1>Create Questions</h1>
    <form id="surveyForm" action="{{ route('create-question') }}" method="POST">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div id="questionsContainer"></div>

        <button type="button" class="btn btn-secondary mt-3" id="addQuestionButton">Add Question</button>
        <button type="submit" class="btn btn-primary mt-3">Submit Survey</button>
    </form>
</div>

@push('script')

<script>
    let questionCount = 0;

    function addQuestion() {
        questionCount++;
        const questionHtml = `
            <div class="card mb-3" id="question-${questionCount}">
                <div class="card-body">
                    <h5 class="card-title">Question ${questionCount}</h5>
                    <div class="mb-3">
                        <label for="questionText-${questionCount}" class="form-label">Question Text</label>
                        <input type="text" class="form-control" id="questionText-${questionCount}" name="questions[${questionCount}][text]" required>
                    </div>
                    <div class="mb-3">
                        <label for="questionType-${questionCount}" class="form-label">Question Type</label>
                        <select class="form-select" id="questionType-${questionCount}" name="questions[${questionCount}][type]" onchange="changeQuestionType(${questionCount})" required>
                            <option value="text">Text</option>
                            <option value="multiple_choice">Multiple Choice</option>
                        </select>
                    </div>
                    <div id="optionsContainer-${questionCount}" class="mb-3"></div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="required-${questionCount}" name="questions[${questionCount}][required]">
                        <label class="form-check-label" for="required-${questionCount}">
                            Required
                        </label>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="removeQuestion(${questionCount})">Remove Question</button>
                </div>
            </div>
        `;
        $('#questionsContainer').append(questionHtml);
    }

    function removeQuestion(questionId) {
        $(`#question-${questionId}`).remove();
    }

    function changeQuestionType(questionId) {
        const questionType = $(`#questionType-${questionId}`).val();
        const optionsContainer = $(`#optionsContainer-${questionId}`);

        if (questionType === 'multiple_choice') {
            optionsContainer.html(`
                <label class="form-label">Options</label>
                <div id="multipleChoiceOptions-${questionId}">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="questions[${questionId}][options][]" placeholder="Option 1" required>
                        <button type="button" class="btn btn-secondary" onclick="addOption(${questionId})">Add Option</button>
                    </div>
                </div>
            `);
        } else {
            optionsContainer.html('');
        }
    }

    function addOption(questionId) {
        const optionsContainer = $(`#multipleChoiceOptions-${questionId}`);
        const optionCount = optionsContainer.find('.input-group').length + 1;
        const optionHtml = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="questions[${questionId}][options][]" placeholder="Option ${optionCount}" required>
                <button type="button" class="btn btn-danger" onclick="removeOption(this)">Remove</button>
            </div>
        `;
        optionsContainer.append(optionHtml);
    }

    function removeOption(optionButton) {
        $(optionButton).closest('.input-group').remove();
    }

    $(document).ready(function () {
        $('#addQuestionButton').click(addQuestion);
    });
</script>
@endpush
@endsection
