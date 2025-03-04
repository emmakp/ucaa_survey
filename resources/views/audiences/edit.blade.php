@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-9">Edit Audience</h4>
                <div class="col-md-3">
                    <a href="{{ route('audiences.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('audiences.update', $audience->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title', $audience->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="validity">Active</label>
                    <input type="checkbox" name="validity" id="validity" value="1" 
                           {{ old('validity', $audience->validity) ? 'checked' : '' }}>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection