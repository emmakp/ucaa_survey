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
        {{-- <div class="form-group mb-3">
            <label for="target_audience">Target Audience</label>
            <select name="target_audience" id="target_audience" class="form-control" required>
                <option value="#" disabled selected>-- Select option --</option>
                @foreach ($audiences as $audience)
                    <option value="{{ $audience->id }}">{{ $audience->title }}</option>
                @endforeach
            </select>
            @if ($errors->has('target_audience'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('target_audience') }}</strong>
                </span>
            @endif
        </div> --}}
        <div class="form-group mb-3">
            <label for="department_id">Department</label>
            <select name="department_id" id="department_id" class="form-control">
                @if (count($departments) > 0)
                    <option value="#" disabled selected>-- Select an option --</option>
                    @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{ $department->Name }}</option>
                    @endforeach
                @else
                    <option value="#" disabled selected>No departments in the system</option>
                @endif
            </select>

            @if ($errors->has('department_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('department_id') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    </div>
</div>
@endsection
