<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Survey - {{ $survey->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .container { max-width: 800px; margin-top: 50px; }
        .alert { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Survey</h1>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('surveys.update', $survey->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $survey->title) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ old('status', $survey->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ old('status', $survey->status) === 'active' ? 'selected' : '' }}>Active</option>
                </select>
                <small class="form-text text-muted">Note: Survey must have at least 3 questions to be set to Active.</small>
            </div>

            <!-- Display Question Count -->
            <div class="mb-3">
                <p>Number of Questions: {{ $survey->questions()->count() }}</p>
                <a href="{{ route('questions.index', ['survey_id' => $survey->id]) }}" class="btn btn-secondary">Manage Questions</a>
            </div>

            <!-- Buttons -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Survey</button>
                <a href="{{ route('surveys.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>