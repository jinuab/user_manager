@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style=" box-shadow: 1px 1px 4px 3px #C2B8B8;background:#fff;margin-top:5%;">
            <br>
            <div class="col-md-12 text-center"  style=" border-bottom:1px dashed #000; padding-bottom:10px;margin-bottom:10px;">
                <img class=" text-center" src="{{ asset('img/logo1.png') }}"/>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li id="register_tab" class="active"><a style="padding-top:4px;padding-bottom:4px" href="#new" role="tab" data-toggle="tab" class="big">New User</a>
                </li>
                <li id="login_tab"><a style="padding-top:4px;padding-bottom:4px" href="#user" role="tab" data-toggle="tab" class="big">I have account</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="new">
                    <br>
                    <fieldset>
                        <form class="register" method="POST">
                            @csrf
                        <div class="form-group">
                            <div class="right-inner-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                                <input class="form-control input-lg" required id="name" autocomplete="off" placeholder="Enter Name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="right-inner-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                                <input class="form-control input-lg" required id="password" autocomplete="off" placeholder="Password" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="right-inner-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                                <input class="form-control input-lg" id="confirm_password" required autocomplete="off" placeholder="Confirm Password" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="right-inner-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                                <input class="form-control input-lg" id="email" required autocomplete="off" placeholder="Enter Email ID" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="right-inner-addon">
                                <i class="glyphicon glyphicon-phone"></i>
                                <input class="form-control input-lg" id="phone" autocomplete="off" placeholder="Enter Phone Number" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control" style="padding:0 15px;font-size: 18px;color: #999;" id="user_role" autocomplete="off" placeholder="Select the Role">
                                <option value="">Select the Role</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <div class=" text-center">
                            <a href="#" class="btn btn-success btn-block" onclick="register();">Sign Up</a>
                        </div>
                        </form>
                    </fieldset>
                </div>
                <div class="tab-pane fade" id="user">
                    <br>
                    <fieldset>
                        <form class="login" method="POST" action="">
                            @csrf
                        <div class="form-group">
                            <div class="right-inner-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                                <input class="form-control input-lg" id="login_email" placeholder="Email Address" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="right-inner-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                                <input class="form-control input-lg" id="login_password" placeholder="Password" type="password">
                            </div>
                        </div>
                        </form>
                    </fieldset>
                    <div class=" text-center">
                        <a href="#" class="btn btn-success btn-block" onclick="login();">LOGIN</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection
