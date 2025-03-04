@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-9">Create Survey</h4>
                <div class="col-md-3">
                    <a href="{{ route('surveys.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('surveys.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="audience_ids">Audiences</label>
                    <!-- <select name="audience_ids[]" id="audience_ids" class="form-control @error('audience_ids') is-invalid @enderror" 
                            multiple required>
                        @foreach ($audiences as $audience)
                            <option value="{{ $audience->id }}">{{ $audience->title }}</option>
                        @endforeach
                    </select> -->
                    <div class="checkbox-group @error('audience_ids') is-invalid @enderror">
                        @foreach ($audiences as $audience)
                            <div class="form-check">
                                <input type="checkbox" name="audience_ids[]" id="audience_{{ $audience->id }}" 
                                       value="{{ $audience->id }}" class="form-check-input"
                                       {{ in_array($audience->id, old('audience_ids', [])) ? 'checked' : '' }}>
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
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection