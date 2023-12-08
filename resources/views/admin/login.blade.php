<?php
/**
 * Created by Paul Iyaji.
 * Date: 23/11/2023
 * Time: 21:08
 * Project Name: monis-api-homebase
 */
?>

@extends('admin/layouts')

@section('content')
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                    <img class="img-responsive center-block" src="{{ URL::asset('assets/imgs/nis_logo2.jpeg') }}" alt="NIS Logo" width="200px" height="120px"/>
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-unlock"></i>
                        </div>
                        <div class="header-title">
                            <h3>Admin Login</h3>
                            <small><strong>Please enter your credentials to login.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (Session::has('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <form action="{{ route('admin/authenticate') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <span class="help-block small">Your unique email to app</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="******">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary pull-right" value="Login">

                        </div>
                    </form>
                </div>
            </div>
            <div id="bottom_text">
                Forgot <a href="{{ url('/forgot-password') }}">Password</a>
            </div>

        </div>
    </div>

@endsection
