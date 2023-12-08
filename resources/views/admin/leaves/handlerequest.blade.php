<?php
/**
 * Created by Paul Iyaji.
 * Date: 06/12/2023
 * Time: 11:24
 * Project Name: monis-api-homebase
 */
?>

@extends('layouts.admin-layout')

@section('content')
    <div class=content-header>
        <div class=header-icon>
            <i class=pe-7s-tools></i>
        </div>
        <div class=header-title>
            <ol class=breadcrumb>
                <li><a href={{ url('dashboard') }}><i class=pe-7s-home></i> Dashboard</a></li>
                <li class=active>Leave Request</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Handle Leave Request </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewLeave" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add New Leave Request</button>
                    </a>
                </div>
                @isset($leave)
                    <div class="panel-body p-l-30">
                        <form action="{{ route('leaves.handlerequest', $leave->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="id" id="id" value="{{ $leave->id }}"/>
                            <div class="form-group">
                                <label for="employee_id" class="col-sm-10">Select Employee<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control"
                                            name="employee_id" id="employee_id">
                                        <option value="">Select Employee </option>
                                        @foreach($employees as $employee)
                                            <option @if($leave->employee_id==$employee->id) selected @endif value="{{ $employee->id }}"
                                                {{$employee->id}}>{{ $employee->last_name }} {{ $employee->first_name }} - {{ $employee->service_number }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-10">Status<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="status" id="status" >
                                        <option value="">Select Status</option>
                                        @foreach($statuses as $status)
                                            <option @if($leave->status==$status->id) selected @endif value="{{ $status->id }}"
                                                {{$status->id}}>{{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="remarks" class="col-sm-10">Enter Remarks<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="remarks" name="remarks" placeholder="Enter remarks" value="" maxlength="1000" >
                                        {{ old('remarks') }}
                                    </textarea>
                                    <span class="text-danger" id="remarksError"></span>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="{{ route('leaves.index') }}" class="btn btn-danger" style="background-color: rgba(222,72,89,0.96); color: white;">Close</a>
                                <button type="submit" class="btn btn-success">Save changes</button>
                            </div>

                        </form>
                    </div>
                @endisset
            </div>
        </div>


    </div>


@endsection


