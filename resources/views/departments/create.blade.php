@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h4>Create Department</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('departments.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="Name">Department Name</label>
                    <input type="text" name="Name" id="Name" class="form-control @error('Name') is-invalid @enderror" 
                           value="{{ old('Name') }}" required>
                    @error('Name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="is_active">Active</label>
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                           {{ old('is_active') ? 'checked' : '' }}>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection