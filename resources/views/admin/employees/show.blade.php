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
                        @isset($employee)
                        <h4><strong>{{ $employee->last_name }}</strong>, {{ $employee->first_name }}'s Profile  ({{ $employee->service_number }})</h4>
                        @endisset
                    </div>
                    <a href="{{ route('employees.index') }}" style="float:right;">
                        <button type="button" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-rotate-left text-white fa-lg"></i> Go Back</button>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-b-20 m-l-0 m-r-0">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Personal Data</a></li>
                            <li><a href="#tab2" data-toggle="tab">Official Data</a></li>
                            <li><a href="#tab3" data-toggle="tab">Next of Kin</a></li>
                            <li><a href="#tab4" data-toggle="tab">Leave</a></li>
                            <li><a href="#tab5" data-toggle="tab">Transfer</a></li>
                            <li><a href="#tab6" data-toggle="tab">Promotion</a></li>
                            <li><a href="#tab7" data-toggle="tab">Deployment</a></li>
                            <li><a href="#tab8" data-toggle="tab">Discipline</a></li>
                            <li><a href="#tab9" data-toggle="tab">Trainings</a></li>
                        </ul>
                        <!-- Tab panels -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1">
                                <div class="panel-body">
                                    <p><strong>Personal Information </strong></p>
                                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                       @isset($employee)
                                        <tr>
                                            <th><img src="{{ asset('storage/imgs/'.$employee->photograph) }}" height="200px" width="200px" alt="passport photo"></th>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td>{{ $employee->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>First Name</th>
                                            <td>{{ $employee->first_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Other Names</th>
                                            <td>{{ $employee->other_names }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth</th>
                                            <td>{{ $employee->date_of_birth }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{ $employee->genders->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nationality</th>
                                            <td>{{ $employee->nationalities->nationality }}</td>
                                        </tr>
                                        <tr>
                                            <th>State of Origin</th>
                                            <td>{{ $employee->geoState->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>LGA</th>
                                            <td>{{ $employee->geoLga->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Number</th>
                                            <td>{{ $employee->contact_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Height</th>
                                            <td>{{ $employee->height }}</td>
                                        </tr>
                                        <tr>
                                            <th>Blood Group</th>
                                            <td>{{ $employee->blood_group }}</td>
                                        </tr>
                                        <tr>
                                            <th>Genotype</th>
                                            <td>{{ $employee->genotype }}</td>
                                        </tr>
                                        <tr>
                                            <th>Marital Status</th>
                                            <td>{{ $employee->maritalstatus->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Zip Code</th>
                                            <td>{{ $employee->zip_code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Residential Address</th>
                                            <td>{{ $employee->residential_address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Permanent Home Address</th>
                                            <td>{{ $employee->permanent_home_address }}</td>
                                        </tr>
                                           @endisset
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2">
                                <div class="panel-body">
                                    <p><strong>Official Information </strong></p>
                                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                        @isset($employee)
                                        <tr>
                                            <th>Service Number</th>
                                            <td>{{ $employee->service_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Rank / Grade Level</th>
                                            <td>{{ $employee->ranks->rank }}</td>
                                        </tr>
                                        <tr>
                                            <th>Step</th>
                                            <td>{{ $employee->step }}</td>
                                        </tr>
                                        <tr>
                                            <th>Hire Date</th>
                                            <td>{{ $employee->hire_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Designation</th>
                                            <td>{{ $employee->designations->designation }}</td>
                                        </tr>
                                        <tr>
                                            <th>Command</th>
                                            <td>{{ $employee->commands->command }}</td>
                                        </tr>
                                        <tr>
                                            <th>Office</th>
                                            <td>{{ $employee->offices->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Directorate</th>
                                            <td>{{ $employee->departments->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Division</th>
                                            <td>{{ $employee->divisions->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Unit</th>
                                            <td>{{ $employee->units->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Duty Post</th>
                                            <td>{{ $employee->duty_post }}</td>
                                        </tr>
                                        <tr>
                                            <th>National Identification Number</th>
                                            <td>{{ $employee->nin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Passport Number</th>
                                            <td>{{ $employee->passport_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Exit Date</th>
                                            <td>{{ $employee->exit_date }}</td>
                                        </tr>
                                        @endisset
                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab3">
                                <div class="panel-body">
                                    <p><strong>Next of Kin Information </strong></p>
                                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                        @isset($employee)
                                        <tr>
                                            <th>Next of Kin</th>
                                            <td>{{ $employee->next_of_kin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Next of Kin Number</th>
                                            <td>{{ $employee->nok_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Next of Kin Email</th>
                                            <td>{{ $employee->nok_email }}</td>
                                        </tr>
                                        @endisset
                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab4">
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
                            <div class="tab-pane fade" id="tab5">
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
                                                        <td>{{ $transfer->employees->service_number }}</tH>
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
                            <div class="tab-pane fade" id="tab6">
                                <div class="panel-body">
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
                            <div class="tab-pane fade" id="tab7">
                                <div class="panel-body">
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
                            <div class="tab-pane fade" id="tab8">
                                <div class="panel-body">
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
                            <div class="tab-pane fade" id="tab9">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
