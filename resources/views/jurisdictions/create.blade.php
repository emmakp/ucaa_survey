@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <div class="row">
            <h4 class="col-md-9">Create Jurisdiction</h4>
            <div class="col-md-3">
                <a href="{{ route('jurisdictions.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('jurisdictions.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Jurisdiction Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="is_active">Active</label>
                <input type="checkbox" name="is_active" id="is_active" value="1" checked>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection