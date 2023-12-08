<?php
/**
 * Created by Paul Iyaji.
 * Date: 06/12/2023
 * Time: 13:14
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
                <li class=active>All Transfers</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Transfers </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewTransfer" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Make A Transfer</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Current Location</th>
                                <th>New Location</th>
                                <th>Transfer Date</th>
                                <th>Reason</th>
                                <th>Authorized By</th>
                                <th>Created By</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($transfers)
                                @foreach($transfers as $transfer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{ $transfer->employees->service_number }}</tH>
                                        <td>{{ $transfer->current_location }}</td>
                                        <td>{{ $transfer->new_location }}</td>
                                        <td>{{ $transfer->transfer_date }}</td>
                                        <td>{{ $transfer->reason }}</td>
                                        <td>{{ $transfer->authorized_by }}</td>
                                        <td>{{ $transfer->created_by }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="transferedit" href="javascript:void(0)" data-id="{{ $transfer->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Transfer Details</a></li>
                                                    <li style="padding-bottom: 3px"><a class="transferdelete" href="javascript:void(0)" data-id="{{ $transfer->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
                                                            <i class="fa fa-trash"></i> Delete Record</a></li>
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
        <!-- boostrap model for transfer -->
        <div class="modal fade" id="ajax-transfer-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxtransferModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEdittransferForm" name="addEdittransferForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="employee_id" class="col-sm-10">Select Employee<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control"
                                            name="employee_id" id="employee_id">
                                        <option value="">Select Employee </option>
                                        @foreach($employees as $employee)
                                            <option @isset($employee) @if($employee->employee_id==$employee->id) selected @endif @endisset value="{{ $employee->id }}"
                                                {{$employee->id}}>{{ $employee->last_name }} {{ $employee->first_name }} - {{ $employee->service_number }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="employee_idError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="current_location" class="col-sm-10">Enter Current Location<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="current_location" name="current_location" placeholder="Enter current location" value="{{ old('current_location') }}">
                                    <span class="text-danger" id="current_locationError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_location" class="col-sm-10">Enter New Location<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="new_location" name="new_location" placeholder="Enter new location" value="{{ old('new_location') }}">
                                    <span class="text-danger" id="new_locationError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="transfer_date" class="col-sm-10">Enter Date of Transfer<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="transfer_date" name="transfer_date" value="{{ old('transfer_date') }}">
                                    <span class="text-danger" id="transfer_dateError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="authorized_by" class="col-sm-10">Enter Authorizing Officer<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="authorized_by" name="authorized_by" placeholder="Enter Name of Authorizing Officer" value="{{ old('authorized_by') }}">
                                    <span class="text-danger" id="authorized_byError"></span>
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
                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewTransfer">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

