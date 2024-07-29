@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <div class="row">
            <h4 class="col-md-9">Create Survey</h4>
            <div class="col-md-3"><a href="{{ route('surveys.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Back</a></div>
        </div>
    </div>
    <div class="card-body">
    <form action="{{ route('surveys.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    </div>
</div>
@endsection
