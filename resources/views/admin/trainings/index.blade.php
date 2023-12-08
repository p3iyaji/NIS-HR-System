<?php
/**
 * Created by Paul Iyaji.
 * Date: 06/12/2023
 * Time: 17:12
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
                <li class=active>All Trainings</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Trainings </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewTraining" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add New Training</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Officer</th>
                                <th>Training</th>
                                <th>Institute</th>
                                <th>Location</th>
                                <th>Duration</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @isset($trainings)
                                @foreach($trainings as $training)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{ $training->employees->service_number }}</tH>
                                        <td>{{ $training->traininglists->title }}</td>
                                        <th>{{ $training->training_institute }}</th>
                                        <td>{{ $training->training_location }}</td>
                                        <td>{{ $training->training_duration }}</td>
                                        <td>{{ $training->training_start_date }}</td>
                                        <td>{{ $training->training_end_date }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="edit" href="javascript:void(0)" data-id="{{ $training->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Training Type</a></li>
                                                    <li style="padding-bottom: 3px"><a class="trainingdelete" href="javascript:void(0)" data-id="{{ $training->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
                                                            <i class="fa fa-trash"></i> Delete Training Type</a></li>
                                                </ul>

                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- boostrap model for Office -->
        <div class="modal fade" id="ajax-training-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxTrainingModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditTrainingForm" name="addEditTrainingForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                <label for="training_list_id" class="col-sm-10">Select Training<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control"
                                            name="training_list_id" id="training_list_id">
                                        <option value="">Select Training </option>
                                        @foreach($traininglists as $traininglist)
                                            <option @isset($training) @if($training->training_list_id==$traininglist->id) selected @endif @endisset value="{{ $employee->id }}"
                                                {{$traininglist->id}}>{{ $traininglist->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="training_list_idError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="training_institute" class="col-sm-10">Enter Institution<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="training_institute" name="training_institute" placeholder="Enter Name of Institute" value="{{ old('training_institute') }}">
                                    <span class="text-danger" id="training_instituteError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="training_location" class="col-sm-10">Enter Location<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="training_location" name="training_location" placeholder="Enter Location" value="{{ old('training_location') }}">
                                    <span class="text-danger" id="training_locationError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="training_duration" class="col-sm-10">Enter Duration<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="training_duration" name="training_duration" placeholder="Enter Duration in Days" value="{{ old('training_duration') }}">
                                    <span class="text-danger" id="training_durationError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="training_start_date" class="col-sm-10">Enter Start Date<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="training_start_date" name="training_start_date" value="{{ old('training_start_date') }}">
                                    <span class="text-danger" id="training_start_dateError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="training_end_date" class="col-sm-10">Enter End Date<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="training_end_date" name="training_end_date" value="{{ old('training_end_date') }}">
                                    <span class="text-danger" id="training_end_dateError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewTraining">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>


@endsection


