<?php
/**
 * Created by Paul Iyaji.
 * Date: 03/12/2023
 * Time: 10:03
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
                <li class=active>Leave Record</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Leave Records </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewLeave" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Leave</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Service No.</th>
                                <th>Type</th>
                                <th>No. of Days</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Date Applied</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($leaves)
                                @foreach($leaves as $leave)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $leave->employees->service_number }}</td>
                                        <td>{{ $leave->leavetypes->type }}</td>
                                        <td>{{ $leave->leave_days }}</td>
                                        <td>{{ $leave->start_date }}</td>
                                        <td>{{ $leave->end_date }}</td>
                                        <td>
                                            @if($leave->status == "1")
                                            <a href="{{ route('leaves-handle', $leave->id) }}" class="btn btn-primary btn-block">{{ $leave->statuses->status }}</a>
                                            @elseif($leave->status == "2")
                                                <a href="{{ route('leaves-handle', $leave->id) }}" class="btn btn-success btn-block">{{ $leave->statuses->status }}</a>
                                            @elseif($leave->status == "3")
                                                <a href="{{ route('leaves-handle', $leave->id) }}" class="btn btn-danger btn-block">{{ $leave->statuses->status }}</a>
                                            @else
                                                <a href="{{ route('leaves-handle', $leave->id) }}" class="btn btn-primary btn-block">Request Cancelled</a>
                                            @endif

                                        </td>
                                        <td>{{ $leave->date_applied }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="edit" href="javascript:void(0)" data-id="{{ $leave->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Leave</a></li>
                                                    <li style="padding-bottom: 3px"><a href="{{ route('leaves-handle', $leave->id) }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-"></i> Handle Request</a></li>
                                                    <li style="padding-bottom: 3px"><a href="{{ route('leaves-cancel', $leave->id) }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-"></i> Cancel Request</a></li>

                                                </ul>

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- boostrap model for Office -->
        <div class="modal fade" id="ajax-leave-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxLeaveModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditLeaveForm" name="addEditLeaveForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="employee_id" class="col-sm-10">Select Employee<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control"
                                            name="employee_id" id="employee_id">
                                        <option value="">Select Employee </option>
                                        @foreach($employees as $employee)
                                            <option @if($employee->employee_id==$employee->id) selected @endif value="{{ $employee->id }}"
                                                {{$employee->id}}>{{ $employee->last_name }} {{ $employee->first_name }} - {{ $employee->service_number }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="employee_idError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="leave_type_id" class="col-sm-10">Select Leave Type<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control"
                                            name="leave_type_id" id="leave_type_id">
                                        <option value="">Select Leave Type </option>
                                        @foreach($leavetypes as $leavetype)
                                            <option @if($leavetype->leave_type_id==$leavetype->id) selected @endif value="{{ $leavetype->id }}"
                                                {{$leavetype->id}}>{{ $leavetype->type }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="leave_type_idError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="leave_days" class="col-sm-10">Enter No. of Days<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="leave_days" name="leave_days" placeholder="Enter No. of Days" value="{{ old('leave_days') }}">
                                    <span class="text-danger" id="leave_daysError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start_date" class="col-sm-10">Select Leave Start Date<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" value="{{ old('start_date') }}">
                                    <span class="text-danger" id="start_dateError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="col-sm-10">Select Leave End Date<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date" value="{{ old('end_date') }}" >
                                    <span class="text-danger" id="end_dateError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reason" class="col-sm-10">Enter Leave Reason<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="reason" name="reason" placeholder="Enter leave reason" value="" maxlength="1000" >
                                        {{ old('reason') }}
                                    </textarea>
                                    <span class="text-danger" id="reasonError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_applied" class="col-sm-10">Date of Application<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="date_applied" name="date_applied" value="{{ old('date_applied') }}">
                                    <span class="text-danger" id="date_appliedError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewLeave">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        @isset($leave)
        <div class="modal fade" id="ajax-handleleave-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxHandleLeaveModel"></h4>
                    </div>
                    <div class="modal-body">
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
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endisset
    </div>


@endsection

