<?php
/**
 * Created by Paul Iyaji.
 * Date: 23/11/2023
 * Time: 21:30
 * Project Name: monis-api-homebase
 */
?>
@extends('auth.layouts2')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @else
                        <div class="alert alert-success">
                            You are logged in!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
