@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Question Details</h1>
    <p><strong>ID:</strong> {{ $questionaire->obfuscator }}</p>
    <p><strong>Survey:</strong> {{ $questionaire->survey->title }}</p>
    <p><strong>Target Audience:</strong> {{ $questionaire->target_audience_rq->title }}</p>
    {{-- <p><strong>Questions:</strong> {{ $question->question }}</p>
    <p><strong>Questionnaire ID:</strong> {{ $question->questionaire_id }}</p>
    <p><strong>Question Type:</strong> {{ $question->question_type }}</p>
    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to List</a> --}}
    <h1>Create Questions</h1>
    <form id="surveyForm" action="{{ route('create-question') }}" method="POST">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="questionaire_id" value="{{ $questionaire->id }}">

        <div id="questionsContainer"></div>

        <button type="button" class="btn btn-secondary mt-3" id="addQuestionButton">Add Question</button>
        <button type="submit" class="btn btn-primary mt-3">Submit Survey</button>
    </form>
</div>

<div class="table-hover">
    @if (count($questionaire->questions) > 0)
        <table class="table" id="datatablesSimple">
            <thead>
                <th>#</th>
                <th>Question</th>
                <th>Question Type</th>
                <th>Date</th>
                <th>Action</th>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($questionaire->questions as $record)
                    <tr>
                        <td>{{ $counter }}</td>
                        <td>{{ $record->question }}</td>
                        <td>{{ $record->question_type }}</td>
                        <td>{{ $record->created_at->setTimezone('Africa/Nairobi') }}</td>
                        <td>
                            <form action="{{ route('questions.destroy', $record->id) }}" method="post">
                                    @method('DELETE')
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>

                            </form>
                        </td>
                    </tr>
                    @php
                        ++$counter;
                    @endphp
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-danger mt-4">
            <p>No questions for this survey in the System</p>
        </div>
    @endif
</div>

@push('script')

<script>
    window.addEventListener('DOMContentLoaded', event => {

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
    });
    let questionCount = 0;

    function addQuestion() {
        const questionHtml = `
            <div class="card mb-3 question-card" id="question-${questionCount}">
                <div class="card-body">
                    <h5 class="card-title">Question ${questionCount + 1}</h5>
                    <div class="mb-3">
                        <label for="questionText-${questionCount}" class="form-label">Question Text</label>
                        <input type="text" class="form-control" id="questionText-${questionCount}" name="questions[${questionCount}][text]" required>
                    </div>
                    <div class="mb-3">
                        <label for="questionType-${questionCount}" class="form-label">Question Type</label>
                        <select class="form-select question-type-select" id="questionType-${questionCount}" name="questions[${questionCount}][type]" required>
                            <option value="text">Text</option>
                            <option value="yes_no">Yes/No</option>
                            <option value="star_rating">Rating with stars</option>
                            <option value="emoji_rating">Rating with emojis</option>
                            <option value="number_rating">Rating with numbers</option>
                            <option value="radio_button_gender">Radio Buttons (Gender)</option>
                            <option value="radio_button_experience">Radio Buttons (Experience)</option>
                            <option value="multiple_choice">Dropdown</option>
                        </select>
                    </div>
                    <div id="optionsContainer-${questionCount}" class="mb-3 options-container"></div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="required-${questionCount}" name="questions[${questionCount}][required]">
                        <label class="form-check-label" for="required-${questionCount}">Required</label>
                    </div>
                    <button type="button" class="btn btn-danger remove-question-button">Remove Question</button>
                </div>
            </div>
        `;
        // <option value="star_rating">Star Rating</option>
        // <option value="number_rating">Number Rating</option>
        // <option value="multiple_checkbox">Multiple Checkbox</option>

        $('#questionsContainer').append(questionHtml);
        questionCount++;
    }

    $(document).on('change', '.question-type-select', function() {
        const questionId = $(this).closest('.question-card').attr('id').split('-')[1];
        changeQuestionType(questionId);
    });

    function changeQuestionType(questionId) {
        const questionType = $(`#questionType-${questionId}`).val();
        const optionsContainer = $(`#optionsContainer-${questionId}`);

        switch (questionType) {
            case 'multiple_choice':
            case 'multiple_checkbox':
                optionsContainer.html(`
                    <label class="form-label">Options</label>
                    <div id="options-${questionId}">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="questions[${questionId}][options][]" placeholder="Option 1" required>
                            <button type="button" class="btn btn-secondary add-option-button" data-question-id="${questionId}">Add Option</button>
                    </div>
                </div>
            `);
            break;
        // case 'star_rating':
        //     optionsContainer.html(`
        //         <label class="form-label">Number of Stars</label>
        //         <input type="number" class="form-control" name="questions[${questionId}][stars]" placeholder="5" required>
        //     `);
        //     break;
        case 'number_rating':
            optionsContainer.html(`
                <label class="form-label">Max Rating</label>
                <input type="number" class="form-control" name="questions[${questionId}][max]" placeholder="10" required>
            `);
            break;
        default:
            optionsContainer.html('');
    }
}

$(document).on('click', '.add-option-button', function() {
    const questionId = $(this).data('question-id');
    addOption(questionId);
});

function addOption(questionId) {
    const optionsContainer = $(`#options-${questionId}`);
    const optionCount = optionsContainer.find('.input-group').length + 1;
    const optionHtml = `
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="questions[${questionId}][options][]" placeholder="Option ${optionCount}" required>
            <button type="button" class="btn btn-danger remove-option-button">Remove</button>
        </div>
    `;
    optionsContainer.append(optionHtml);
}

$(document).on('click', '.remove-option-button', function() {
    $(this).closest('.input-group').remove();
});

$(document).on('click', '.remove-question-button', function() {
    $(this).closest('.question-card').remove();
});

$('#addQuestionButton').click(addQuestion);
</script>
@endpush
@endsection
