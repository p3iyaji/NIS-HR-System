<?php
/**
 * Created by Paul Iyaji.
 * Date: 28/11/2023
 * Time: 12:27
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
                <li class=active>All Departments</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Departments </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewDepartment" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Department</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                                <th>Description</th>
                                <th>Office</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($departments)
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->description }}</td>
                                        <td>{{ $department->offices->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="edit" href="javascript:void(0)" data-id="{{ $department->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Department</a></li>
                                                    <li style="padding-bottom: 3px"><a class="departmentdelete" href="javascript:void(0)" data-id="{{ $department->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
                                                            <i class="fa fa-trash"></i> Delete Department</a></li>
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
        <div class="modal fade" id="ajax-department-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxDepartmentModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditDepartmentForm" name="addEditDepartmentForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="name" class="col-sm-10">Enter Department Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Department Name" value="" maxlength="400">
                                    <span class="text-danger" id="nameError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-10">Enter Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="description" name="description" placeholder="Description" value="" maxlength="400" required ></textarea>
                                    <span class="text-danger" id="descriptionError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="office" class="col-sm-10">Select Office</label>
                                <div class="col-sm-12">
                                    <select class="form-control"
                                            name="office_id" id="office_id" required>
                                        <option value="">Select Office </option>
                                        @foreach($offices as $office)
                                            <option @isset($department) @if($department->office_id==$office->id) selected @endif @endisset value="{{ $office->id }}"
                                                {{$office->id}}>{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="office_idError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewDepartment">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection


