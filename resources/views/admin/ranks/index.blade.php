<?php
/**
 * Created by Paul Iyaji.
 * Date: 30/11/2023
 * Time: 03:29
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
                <li class=active>All Ranks</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>List All Ranks </h4>
                    </div>
                    <a href="javascript:void(0)" style="float:right;">
                        <button type="button" id="addNewRank" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Rank</button>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Rank</th>
                                <th>Grade Level</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($ranks)
                                @foreach($ranks as $rank)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rank->rank }}</td>
                                        <td>{{ $rank->grade_level }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="dLabel" fill="currentColor" class="bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li style="padding-bottom: 3px"><a class="edit" href="javascript:void(0)" data-id="{{ $rank->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}"><i class="fa fa-edit"></i> Edit Rank</a></li>
                                                    <li style="padding-bottom: 3px"><a class="rankdelete" href="javascript:void(0)" data-id="{{ $rank->id }}" style="text-decoration: none; color:#4e4c4c; :hover{background-color: #ab7f65;}">
                                                            <i class="fa fa-trash"></i> Delete Rank</a></li>
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
        <div class="modal fade" id="ajax-rank-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxRankModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditRankForm" name="addEditRankForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">


                            <div class="form-group">
                                <label for="rank" class="col-sm-10">Enter Rank</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="rank" name="rank" placeholder="Enter Office Name" value="" maxlength="400">
                                    <span class="text-danger" id="rankError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="grade_level" class="col-sm-10">Enter Grade Level</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="grade_level" name="grade_level" placeholder="Enter Office Location" value="" maxlength="400">
                                    <span class="text-danger" id="grade_levelError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white;" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-save" value="addNewRank">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

