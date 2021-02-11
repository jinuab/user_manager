@extends('layouts.app')

@section('content')
    @auth

        <div class="container">
            <div class="row">
                <header class="clearfix">
                    <nav class="navbar navbar-default" style="box-shadow: 1px 1px 4px 3px #C2B8B8; padding:10px;">
                        <div class="container">
                            <ul class="nav navbar-nav">
                                <li><a href="" class="navbar-brand" style="padding:6px;"><img class=" text-center" src="img/logo1.png" style="height:40px;"/></a></li>
                                <li style="font-weight:bold;padding-top:15px;">User Management</li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <div class="inset" style="margin-right:20px;">
                                        <h4>Hello <strong>{{ $name ?? 'Guest' }}</strong> </h4>
                                        <h6 class="text-right"><a href="/logout">Logout</a></h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 " style=" box-shadow: 1px 1px 4px 3px #C2B8B8;background:#fff; padding:15px 10px;">
                    @if($role_id==1)
                    <table class="table table-hover table-bordered">
                        <thead  style="background:#4caf50; color:#fff">
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone Number</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($users_data))
                            <tr>
                                <td colspan="5" class="text-center"><strong>No records found!</strong></td>
                            </tr>
                        @endif
                        @foreach($users_data as $user_data)
                        <tr>
                            <td>{{$user_data->name}}</td>
                            <td>@if($user_data->role_id==1) Admin @else User @endif</td>
                            <td>{{$user_data->email}}</td>
                            <td>{{$user_data->phone}}</td>
                            <td class="text-center text-danger"><a href="#" onclick="delete_user({{$user_data->id}});"><i class="glyphicon glyphicon-trash text-danger"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <h1 class="text-center col-lg-12">Welcome {{$name ?? ''}} to user management!</h1>
                        <h4 class="text-center col-lg-12"> Only an administrator can manage all the users!</h4>
                    @endif
                </div>
            </div>
        </div>
    @endauth

    @guest
        <div class="row col-lg-12 text-center">
            <h1>Sorry, you are not logged in!!</h1>
            <a href="/login">Click here to login</a>
        </div>
    @endguest

@endsection
