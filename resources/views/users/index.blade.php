@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-10">User</h4>
                <a href="{{route('register')}}" class="link">Add New User</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row offset-md-1">
                <div class="col col-xs-12">
                    <p>{{ $active_users }}</p>
                    <br>
                    Active Users 
                </div>
                <div class="col col-xs-12">
                    <p>{{ $blocked_users }}</p>
                    <br>
                    Blocked Users
                </div>
                <div class="col col-xs-12">
                    <p>{{ $pending_deletion }}</p>
                    <br>
                    Users Pending Deletion 
                </div>
            </div>
        <hr>
            <div class="table-hover">
                @if (count($users) > 0)
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>User's Name</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>User Role</th>
                            <th>Phone Number</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        @if(isset($user->pic))
                                            <img src="{{ asset($user->pic->Location).'/'.$user->pic->Name }}" alt="{{$user->FirstName}}'s Picture'" class="img-responsive rounded-circle" style="max-width: 50px;">
                                        @else
                                            <img src="{{ asset('storage/pics/nopic.png') }}" alt="{{$user->FirstName}}'s Picture'" class="img-responsive rounded-circle" style="max-width: 50px;">
                                        @endif
                                    </td>
                                    <td><a href="{{route('staff.show', ['staff' => $user->Obfuscator])}}" class="link">{{$user->user_title->TitleName.' '.$user->FirstName.' '.$user->SecondName }}</a></td>
                                    <td>{{$user->email }}</td>
                                    <td>{{$user->username }}</td>
                                    <td><span class="badge badge-success">{{$user->user_role->RoleName }}</span></td>
                                    <td>0{{$user->PhoneNumber }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No users in the System</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection