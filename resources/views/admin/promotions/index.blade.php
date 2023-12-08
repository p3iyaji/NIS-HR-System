<?php
/**
 * Created by Paul Iyaji.
 * Date: 07/12/2023
 * Time: 06:44
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
                <li class=active>All Promotions</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Promotions </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewpromotion" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add A Promotion</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Old Rank</th>
                                <th>New Rank</th>
                                <th>Old Job Title</th>
                                <th>New Job Title</th>
                                <th>promotion Date</th>
                                <th>Duration on Rank</th>
                                <th>Next Promotion</th>
                                <th>Created By</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($promotions)
                                @foreach($promotions as $promotion)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{ $promotion->employees->service_number }}</tH>
                                        <td>{{ $promotion->old_rank }}</td>
                                        <td>{{ $promotion->new_rank }}</td>
                                        <td>{{ $promotion->old_job_title }}</td>
                                        <td>{{ $promotion->new_job_title }}</td>
                                        <td>{{ $promotion->promotion_date }}</td>
                                        <td>{{ $promotion->rank_duration }}</td>
                                        <td>{{ $promotion->next_promotion_due_date }}</td>
                                        <td>{{ $promotion->created_by }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="promotionedit" href="javascript:void(0)" data-id="{{ $promotion->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Promotion Details</a></li>
                                                    <li style="padding-bottom: 3px"><a class="promotiondelete" href="javascript:void(0)" data-id="{{ $promotion->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
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
        <!-- boostrap model for promotion -->
        <div class="modal fade" id="ajax-promotion-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxpromotionModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditpromotionForm" name="addEditpromotionForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                                <label for="old_rank" class="col-sm-10">Enter Old Rank<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="old_rank" name="old_rank" placeholder="Enter Old Rank" value="{{ old('old_rank') }}">
                                    <span class="text-danger" id="old_rankError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_rank" class="col-sm-10">Enter New Rank<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="new_rank" name="new_rank" placeholder="Enter New Rank" value="{{ old('new_rank') }}">
                                    <span class="text-danger" id="new_rankError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="old_job_title" class="col-sm-10">Enter Old Job Title<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="old_job_title" name="old_job_title" placeholder="Enter Old Job Title" value="{{ old('old_job_title') }}">
                                    <span class="text-danger" id="old_job_titleError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_job_title" class="col-sm-10">Enter New Job Title<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="new_job_title" name="new_job_title" placeholder="Enter New Job Title" value="{{ old('new_job_title') }}">
                                    <span class="text-danger" id="new_job_titleError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="promotion_date" class="col-sm-10">Enter Date of promotion<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="promotion_date" name="promotion_date" value="{{ old('promotion_date') }}">
                                    <span class="text-danger" id="promotion_dateError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rank_duration" class="col-sm-10">Enter New Rank Duration<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="rank_duration" name="rank_duration" placeholder="Enter New Rank Duration in Years" value="{{ old('rank_duration') }}">
                                    <span class="text-danger" id="rank_durationError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="next_promotion_due_date" class="col-sm-10">Enter Next Promotion Date<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="next_promotion_due_date" name="next_promotion_due_date" value="{{ old('next_promotion_due_date') }}">
                                    <span class="text-danger" id="next_promotion_due_dateError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewpromotion">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

