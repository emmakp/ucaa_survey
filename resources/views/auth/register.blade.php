@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Titles --}}
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required> --}}

                                <select name="title" id="title" class="form-control">
                                    @if (count($titles) < 1)
                                        <option value="0" selected disabled>No User Roles in the system</option>
                                    @else
                                        <option value="0" selected disabled>-- Choose an option --</option>
                                        @foreach ($titles as $title)
                                            <option value="{{$title->id}}">{{ $title->TitleName }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
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
                            <label for="SecondName" class="col-md-4 col-form-label text-md-right">{{ __('Second Name') }}</label>

                            <div class="col-md-6">
                                <input id="SecondName" type="text" class="form-control{{ $errors->has('SecondName') ? ' is-invalid' : '' }}" name="SecondName" value="{{ old('SecondName') }}" required autofocus>

                                @if ($errors->has('SecondName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('SecondName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Field for user name --}}
                        <div class="form-group row">
                            <label for="UserName" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="UserName" type="text" class="form-control{{ $errors->has('UserName') ? ' is-invalid' : '' }}" name="UserName" value="{{ old('UserName') }}" required autofocus>

                                @if ($errors->has('UserName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('UserName') }}</strong>
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
                        {{-- <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div> --}}
                        {{-- Gender --}}
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('gender') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required> --}}

                                {{-- <select name="gender" id="gender" class="form-control">
                                    <option value="0" selected disabled>-- Choose an option --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select> --}}
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

                        {{-- User Roles --}}
                        <div class="form-group row">
                            <label for="userrole" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="userrole" type="text" class="form-control{{ $errors->has('userrole') ? ' is-invalid' : '' }}" name="userrole" value="{{ old('userrole') }}" required> --}}

                                <select name="userrole" id="userrole" class="form-control">
                                    @if (count($userRoles) < 1)
                                        <option value="0" selected disabled>No User Roles in the system</option>
                                    @else
                                        <option value="0" selected disabled>-- Choose an option --</option>
                                        @foreach ($userRoles as $role)
                                            <option value="{{$role->id}}">{{ $role->RoleName }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('userrole'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('userrole') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        {{-- Pic --}}
                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Picture') }}</label>

                            <div class="col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input rounded-0" id="fileUpload" name="file">
                                    <label class="custom-file-label color-5 rounded-0" for="fileUpload">Choose File</label>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="col-md-2 offset-md-3">
                                <a href="{{ route('staff.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
