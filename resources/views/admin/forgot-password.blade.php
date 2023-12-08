<?php
/**
 * Created by Paul Iyaji.
 * Date: 23/11/2023
 * Time: 23:31
 * Project Name: monis-api-homebase
 */
?>
@extends('auth/layouts')

@section('content')
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-refresh-2"></i>
                        </div>
                        <div class="header-title">
                            <h3>Password Reset</h3>
                            <small><strong>Please fill the form to recover your password</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <form action="{{ route('forgot.password.post') }}" method="POST">
                        @csrf
                        <p>Fill with your mail to receive instructions on how to reset your password.</p>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="email" class="form-control" name="email" placeholder="Please enter you email adress" type="email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
