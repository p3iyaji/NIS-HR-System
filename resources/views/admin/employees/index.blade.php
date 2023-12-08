<?php
/**
 * Created by Paul Iyaji.
 * Date: 29/11/2023
 * Time: 13:33
 * Project Name: monis-api-homebase
 */
?>
@extends('layouts.admin-layout')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Employees </h4>
                    </div>
                    <a href="{{ route('employees.create') }}" style="float:right;">
                        <button type="button" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Employee</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Service No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Other Names</th>
                                <th>Command</th>
                                <th>Office</th>
                                <th>Hire Date</th>
                                <th>Rank</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($employees)
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('storage/imgs/'.$employee->photograph) }}" height="40px" width="40px" alt="img"></td>
                                        <td>{{ $employee->service_number }}</td>
                                        <td>{{ $employee->first_name }}</td>
                                        <td>{{ $employee->last_name }}</td>
                                        <td>{{ $employee->other_names }}</td>
                                        <td>{{ $employee->commands->command }}</td>
                                        <td>{{ $employee->offices->name }}</td>
                                        <td>{{ $employee->hire_date }}</td>
                                        <td>{{ $employee->ranks->rank }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px;"><a href="{{ route('employees.edit', $employee->id) }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Employee</a></li>
                                                    <li style="padding-bottom: 3px;"><a href="{{ route('employees.show', $employee->id) }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-eye"></i> View Profile</a></li>
                                                    <li style="padding-bottom: 3px"><a href="{{ route('employees.destroy', $employee->id) }}"  style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
                                                            <i class="fa fa-trash"></i> Delete Employee</a></li>
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
    </div>

@endsection
