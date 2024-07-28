@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <p class="text-primary">{{ $user[0]->user_title->TitleName.' '.$user[0]->FirstName.' '.$user[0]->SecondName }}</p>
            </div>
            <div class="card body">
                <div class="container p-4">
                    <div class="row">
                        <div class="col col-md-7">
                            @if(isset($user[0]->pic))
                                <img src="{{ asset($user[0]->pic->Location).'/'.$user[0]->pic->Name }}" alt="{{$user[0]->FirstName}}'s Picture'" class="img-responsive rounded-circle" style="max-width: 200px;">
                            @else
                                <img src="{{ asset('storage/pics/nopic.png') }}" alt="{{$user[0]->FirstName}}'s Picture'" class="img-responsive rounded-circle" style="max-width: 200px;">
                            @endif
                        </div>
                        <div class="col col-md-5 row mt-5">
                                @if ($user[0]->validity === 0 && $user[0]->deleted_at != NULL)
                                    <div class="col">
                                        {{-- Restore User the user --}}
                                        <form action="{{ route('restore_user', ['staff' => $user[0]->Obfuscator ]) }}" method="POST">
                                        @csrf
                                        <input type="submit" value="Restore User" class="btn btn-success">
                                        </form>
                                    </div>
                                    
                                    <div class="col">
                                        {{-- Restore account --}}
                                        <form action="{{ route('remove_user', ['staff' => $user[0]->Obfuscator ]) }}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input type="submit" value="Permanently Remove User" class="btn btn-danger">
                                        </form>    
                                    </div>
                                @else
                                    <div class="col">
                                        <form action="{{ route('staff.destroy', ['staff' => $user[0]->Obfuscator ]) }}" method="POST">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="submit" value="Remove User" class="btn btn-danger">
                                        </form>
                                    </div>
                                    <div class="col">
                                        @if ($user[0]->validity === 0)
                                            {{-- Button for unblocking user --}}
                                            <form action="{{route('unblock_user', ['staff' => $user[0]->Obfuscator, 'firstname' => $user[0]->FirstName, 'lastname' => $user[0]->SecondName,])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="PATCH">
                                                <input type="submit" value="Unblock User" class="btn btn-success">
                                            </form>
                                            
                                        @else
                                            {{-- Button for blocking user --}}
                                            <form action="{{route('block_user', ['staff' => $user[0]->Obfuscator, 'firstname' => $user[0]->FirstName, 'lastname' => $user[0]->SecondName,])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="submit" value="Block User" class="btn btn-secondary">
                                            </form>
                                        @endif
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <p><span class="font-weight-bold">First Name:</span> {{$user[0]->FirstName}}</p>
                            <p><span class="font-weight-bold">Second Name:</span> {{$user[0]->SecondName}}</p>
                            <p><span class="font-weight-bold">User Name:</span> {{$user[0]->username}}</p>
                            <p>
                                <span class="font-weight-bold">Status:</span>
                                @if ($user[0]->validity === 1)
                                    <span class="badge badge-primary">active</span>
                                @else
                                    <span class="badge badge-danger">blocked</span>
                                @endif
                        </div>
                        <div class="col-6">
                            <p><span class="font-weight-bold">Email:</span> {{$user[0]->email}}</p>
                            <p><span class="font-weight-bold">Gender:</span> {{$user[0]->gender}}</p>
                            <p><span class="font-weight-bold">User Role:</span> {{$user[0]->user_role->RoleName}}</p>
                            <br>
                            <a href="{{ route('staff.edit', ['staff' => $user[0]->Obfuscator]) }}" class="btn btn-primary">Edit User Details</a>
                            <a href="{{ route('staff.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection