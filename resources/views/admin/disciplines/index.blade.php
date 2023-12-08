<?php
/**
 * Created by Paul Iyaji.
 * Date: 07/12/2023
 * Time: 09:49
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
                <li class=active>All Discipline</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Discipline</h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewdiscipline" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add A discipline</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Offence Description</th>
                                <th>Action Taken</th>
                                <th>Reported By</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($disciplines)
                                @foreach($disciplines as $discipline)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{ $discipline->employees->service_number }}</tH>
                                        <td>{{ $discipline->offence_desc }}</td>
                                        <td>{{ $discipline->action_taken }}</td>
                                        <td>{{ $discipline->reported_by }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="disciplineedit" href="javascript:void(0)" data-id="{{ $discipline->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Discipline Details</a></li>
                                                    <li style="padding-bottom: 3px"><a class="disciplinedelete" href="javascript:void(0)" data-id="{{ $discipline->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
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
        <!-- boostrap model for discipline -->
        <div class="modal fade" id="ajax-discipline-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxdisciplineModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditdisciplineForm" name="addEditdisciplineForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                <label for="reason" class="col-sm-10">Enter Offence Description<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="offence_desc" name="offence_desc" placeholder="Enter Description" value="" maxlength="1000" >
                                        {{ old('offence_desc') }}
                                    </textarea>
                                    <span class="text-danger" id="offence_descError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reason" class="col-sm-10">Enter Action Taken<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="action_taken" name="action_taken" placeholder="Enter Action" value="" maxlength="1000" >
                                        {{ old('action_taken') }}
                                    </textarea>
                                    <span class="text-danger" id="action_takenError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reported_by" class="col-sm-10">Reported By<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="reported_by" name="reported_by" value="{{ old('reported_by') }}">
                                    <span class="text-danger" id="reported_byError"></span>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewdiscipline">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

