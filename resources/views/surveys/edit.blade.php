@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <h4>Edit Survey - {{ $survey->title }}</h4>
        </div>
        <div class="card-body">
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
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title', $survey->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="pending" {{ old('status', $survey->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="active" {{ old('status', $survey->status) === 'active' ? 'selected' : '' }}>Active</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Note: Survey must have at least 3 questions to be set to Active.</small>
                </div>

                <div class="form-group mb-3">
                    <label for="audience_ids">Audiences</label>
                    <div class="checkbox-group @error('audience_ids') is-invalid @enderror">
                        @foreach ($audiences as $audience)
                            <div class="form-check">
                                <input type="checkbox" name="audience_ids[]" id="audience_{{ $audience->id }}" 
                                       value="{{ $audience->id }}" class="form-check-input"
                                       {{ $survey->audiences->contains($audience->id) ? 'checked' : '' }}>
                                <label for="audience_{{ $audience->id }}" class="form-check-label">
                                    {{ $audience->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('audience_ids')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <p>Number of Questions: {{ $survey->questions()->count() }}</p>
                    <a href="{{ route('surveys.questionnaires', $survey->id) }}" class="btn btn-secondary">Manage Questions</a>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Survey</button>
                    <a href="{{ route('surveys.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection