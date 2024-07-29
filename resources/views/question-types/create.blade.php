@extends('layouts.app')

@section('content')
<div class="card card-secondary container p-0">
    <div class="card-header">
        <div class="row">
            <h4 class="col-md-9">Create Question Type</h4>
            <div class="col-md-3"><a href="{{ route('question-type.create') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Back</a></div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('question-type.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection
