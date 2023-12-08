<?php
/**
 * Created by Paul Iyaji.
 * Date: 23/11/2023
 * Time: 21:28
 * Project Name: monis-api-homebase
 */
?>
@extends('auth.layouts')

@section('content')

    <div class="register-wrapper">
        <div class="container-center lg">
            <div class="panel panel-bd">
                <img class="img-responsive center-block" src="{{ URL::asset('assets/imgs/nis_logo2.jpeg') }}" alt="NIS Logo" width="200px" height="120px"/>
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-pen"></i>
                        </div>
                        <div class="header-title">
                            <h3>Register</h3>
                            <small><strong>Please enter your data<br> to register.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">First Name *</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="first name">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last Name *</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="last name">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email *</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Please enter you email address">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input id="pass" type="password" class="form-control" name="password" placeholder="******">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <div>
                            <a href="{{ url('/login') }}" class="btn btn-success pull-left m-r-5">Login</a>

                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary pull-right" value="Register">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
