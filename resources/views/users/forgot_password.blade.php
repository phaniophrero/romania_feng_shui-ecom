@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top: 20px;">
    <!--form-->
    <div class="container">
        <div class="row">
            @if(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">&#215;</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">&#215;</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Forgot Password?</h2>
                    <form id="forgotPasswordForm" name="forgotPasswordForm" action="{{ url('/forgot-password') }}"
                        method="post">
                        {{ csrf_field() }}
                        <input id="email" name="email" type="email" placeholder="Email Address" required />
                        <button type="submit" class="btn btn-default">Submit</button><br>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>New User Sign up!</h2>
                    <form id="registerForm" name="registerForm" action="{{ url('/user-register') }}" method="post">
                        {{ csrf_field() }}
                        <input id="name" name="name" type="text" placeholder="Name" />
                        <input id="email" name="email" type="email" placeholder="Email Address" />
                        <input id="myPassword" name="password" type="password" placeholder="Password" />
                        <button type="submit" class="btn btn-default">Sign up</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->

@endsection