@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-10">Add New Department</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('departments.store') }}" method="post">
                @csrf
                
                {{-- Department Name field --}}
                <div class="form-group row">
                    <label for="Name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="Name" type="text" class="form-control{{ $errors->has('Name') ? ' is-invalid' : '' }}" name="Name" value="{{ old('Name') }}" required autofocus>

                        @if ($errors->has('Name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                {{-- Department Description field --}}
                <div class="form-group row">
                    <label for="Description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <textarea id="Description" class="form-control{{ $errors->has('Description') ? ' is-invalid' : '' }}" name="Description" value="{{ old('Description') }}" autofocus>
                        </textarea>

                        @if ($errors->has('Description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection