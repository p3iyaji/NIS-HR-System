<?php
/**
 * Created by Paul Iyaji.
 * Date: 07/12/2023
 * Time: 05:41
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
                <li class=active>All Deployments</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Deployments </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewdeployment" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Make A Deployment</button>
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
                                <th>Deployment Date</th>
                                <th>Reason</th>
                                <th>Authorized By</th>
                                <th>Created By</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($deployments)
                                @foreach($deployments as $deployment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{ $deployment->employees->service_number }}</tH>
                                        <td>{{ $deployment->current_location }}</td>
                                        <td>{{ $deployment->location_of_deployment }}</td>
                                        <td>{{ $deployment->deployment_date }}</td>
                                        <td>{{ $deployment->reason }}</td>
                                        <td>{{ $deployment->authorized_by }}</td>
                                        <td>{{ $deployment->created_by }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="deploymentedit" href="javascript:void(0)" data-id="{{ $deployment->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Deployment Details</a></li>
                                                    <li style="padding-bottom: 3px"><a class="deploymentdelete" href="javascript:void(0)" data-id="{{ $deployment->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
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
        <!-- boostrap model for deployment -->
        <div class="modal fade" id="ajax-deployment-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxdeploymentModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditdeploymentForm" name="addEditdeploymentForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                <label for="location_of_deployment" class="col-sm-10">Enter New Location<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="location_of_deployment" name="location_of_deployment" placeholder="Enter new location" value="{{ old('location_of_deployment') }}">
                                    <span class="text-danger" id="location_of_deploymentError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="deployment_date" class="col-sm-10">Enter Date of deployment<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="deployment_date" name="deployment_date" value="{{ old('deployment_date') }}">
                                    <span class="text-danger" id="deployment_dateError"></span>
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
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewdeployment">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection


