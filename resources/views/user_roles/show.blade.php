@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-10"><span><i class="mdi mdi-key mdi-24px"></i></span> {{ $user_role->RoleName }} - User Role</h4>
                <a href="{{route('user-roles.create')}}" class="link">Add New User Role</a>
            </div>
        </div>
        <div class="card-body">
            {{-- <form action="{{('')}}" method="post"></form> --}}
            <form action="{{ route('user-roles.update', ['user_role' => $user_role->id])}}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="UserRoleID" value="{{$user_role->id}}">
                <div class="row">
                    @foreach ($controllers as $controller)
                        @if ($controller->Name === 'FileDownloadController' || $controller->Name === 'BackgroundServicesController' || $controller->Name === 'Auth\\ForgotPasswordController' || $controller->Name === 'Auth\\LoginController' || $controller->Name === 'Auth\\ResetPasswordController' || $controller->Name === 'Auth\VerificationController')
                            @php
                                continue;
                            @endphp
                        @endif
                        <div class="card card-secondary container p-0 ml-1 col-md-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="form-check">
                                        <input class="form-check-input CTR-checkbox" type="checkbox" value="{{ $controller->id }}" id="CTR-{{$controller->id}}" name="CTR[{{$controller->id}}]">
                                        <label class="form-check-label" for="CTR-{{$controller->id}}">
                                            @php
                                                $str = str_replace("Auth\\", '', $controller->Name);
                                                $str = str_replace('Controller', '', $str);
                                                $str = preg_split('/(?=[A-Z])/',$str);
                                                $str = implode(" ", $str);
                                            @endphp
                                            {{ $str }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @isset($controller->functions)
                                    @foreach ($controller->functions as $function)
                                        @if ($function->Name === 'postChangePassword'  || $function->Name === 'getChangePassword'  || $function->Name === 'drugqty' || $function->Name === 'store'  || $function->Name === 'update' || $function->Name === 'showRegistrationForm')
                                            @php
                                                continue;
                                            @endphp
                                        @endif
                                        <div class="form-check">
                                            <input class="form-check-input CTR-{{$controller->id}}" type="checkbox" value="{{ $function->id }}" id="FTC-{{$function->id}}" name="CTR[{{$controller->id}}][]">
                                            <label class="form-check-label" for="FTC-{{$function->id}}">
                                                {{ $function->Name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="#" id="defaultCheck1" checked disabled>
                                        <label class="form-check-label" for="defaultCheck1">
                                            No functions
                                        </label>
                                    </div>
                                @endisset
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Submit button --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 offset-md-2 col">
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                        <div class="col-md-4 offset-md-1 col">
                            <a href="{{route('user-roles.index')}}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
