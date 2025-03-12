@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Employee')}}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf
                        {{-- Titles --}}
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label> 
                            <div class="col-md-6">
                                <select name="title" id="title" class="form-control">
                                    @if (count($titles) > 0)
                                        <option value="#" disabled selected>-- Select an option --</option>
                                        <option value="N" class="text-success">Add New title</option>
                                        @foreach ($titles as $title)
                                            <option value="{{$title->id}}">{{ $title->TitleName }}</option>
                                        @endforeach
                                    @else
                                        <option value="#" disabled selected>No titles in the system</option>
                                    @endif
                                </select>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                                
                                <span id="newtitlespan">
                                    <br>
                                    <div class="row">
                                        <div class="col-8">
                                            <input id="newtitle" class="form-control" name="newtitle" placeholder="New Title" autofocus value="{{ old('newtitle') }}">
                                        </div>
                                        <div class="col-4">
                                            <input id="newtitleacrynom" class="form-control" name="newtitleacrynom" placeholder="Acrynom" autofocus value="{{ old('newtitleacrynom') }}">
                                        </div>
                                    </div>
                                </span>
    
                                @if ($errors->has('newtitle'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('newtitle') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- Feild for first name --}}
                        <div class="form-group row">
                            <label for="FirstName" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="FirstName" type="text" class="form-control{{ $errors->has('FirstName') ? ' is-invalid' : '' }}" name="FirstName" value="{{ old('FirstName') }}" required autofocus>

                                @if ($errors->has('FirstName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('FirstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Field for second name --}}
                        <div class="form-group row">
                            <label for="SecondName" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="SecondName" type="text" class="form-control{{ $errors->has('SecondName') ? ' is-invalid' : '' }}" name="SecondName" value="{{ old('SecondName') }}" required autofocus>

                                @if ($errors->has('SecondName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('SecondName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Department --}}
                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <select name="department" id="department" class="form-control">
                                    @if (count($departments) > 0)
                                        <option value="#" disabled selected>-- Select an option --</option>
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{ $department->Name }}</option>
                                        @endforeach
                                    @else
                                        <option value="#" disabled selected>No departments in the system</option>
                                    @endif
                                </select>

                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Email Address --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Phone number --}}
                        <div class="form-group row">
                            <label for="PhoneNumber" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">256</span>
                                    </div>
                                    <input id="PhoneNumber" type="text" class="form-control{{ $errors->has('PhoneNumber') ? ' is-invalid' : '' }}" name="PhoneNumber" value="{{ old('PhoneNumber') }}" required placeholder="750000000">
    
                                    @if ($errors->has('PhoneNumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('PhoneNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Gender --}}
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col">
                                        Male: <input type="radio" value="Male" name="gender" class="btn">
                                    </div>
                                    <div class="col">
                                        Female: <input type="radio" value="Female" name="gender" class="btn">
                                    </div>
                                </div>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection