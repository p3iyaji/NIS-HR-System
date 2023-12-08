@extends('layouts.admin-layout')

@section('content')
    <div class=content-header>
        <div class=header-icon>
            <i class=pe-7s-tools></i>
        </div>
        <div class=header-title>
            <ol class=breadcrumb>
                <li><a href={{ url('dashboard') }}><i class=pe-7s-home></i> Dashboard</a></li>
                <li class=active>All Offices</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Offices </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewOffice" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Office</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Command</th>
                                <th>Office</th>
                                <th>Location</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($offices)
                                @foreach($offices as $office)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{ $office->commands->command }}</tH>
                                        <td>{{ $office->name }}</td>
                                        <td>{{ $office->location }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="edit" href="javascript:void(0)" data-id="{{ $office->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Office</a></li>
                                                    <li style="padding-bottom: 3px"><a class="officedelete" href="javascript:void(0)" data-id="{{ $office->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
                                                            <i class="fa fa-trash"></i> Delete Office</a></li>
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
        <div class="modal fade" id="ajax-office-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxOfficeModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditOfficeForm" name="addEditOfficeForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="name" class="col-sm-10">Select Command</label>

                                <div class="col-sm-12">
                                    <select class="form-control"
                                            name="command_id" id="command_id" required>
                                        <option value="">Select Command </option>

                                        @foreach($commands as $command)
                                            <option @isset($office)@if($office->command_id==$command->id) selected @endif @endisset value="{{ $command->id }}"
                                                {{$command->id}}>{{ $command->command }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="command_idError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-10">Enter Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Office Name" value="" maxlength="400">
                                    <span class="text-danger" id="nameError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location" class="col-sm-10">Enter Location</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Office Location" value="" maxlength="400">
                                    <span class="text-danger" id="locationError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewOffice">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
