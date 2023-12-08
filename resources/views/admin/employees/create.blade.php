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
                    <h4>Add New Employee Record </h4>
                </div>
                <a href="{{ route('employees.index') }}" style="float:right;">
                    <button type="button" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                        <i class="fa fa-rotate-left text-white fa-lg"></i> Go Back</button>
                </a>
            </div>
            <div class="panel-body p-l-30">
                <form action="{{ route('employees.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <legend>Personal Data</legend>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="last_name" class="col-md-12">Last Name (Surname)<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" maxlength="400" >
                                    @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="first_name" class="col-md-12">First Name<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" maxlength="400" >
                                    @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="other_names" class="col-md-12">Other Names</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="other_names" name="other_names" placeholder="Other Names" value="{{ old('other_names') }}" maxlength="400">
                                    @error('other_names')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="date_of_birth" class="col-md-12">Date of Birth <span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="date_of_birth" value="{{ old('date_of_birth') }}" >
                                    @error('date_of_birth')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender" class="col-md-12">Gender<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control"
                                            name="gender_id" id="gender_id" value="{{ old('gender_id') }}" >
                                        <option value="">Select Gender</option>
                                        @foreach($genders as $gender)
                                            <option value="{{ $gender->id }}" @if(old('gender_id')==$gender->id) selected @endif
                                                {{$gender->id}}>{{ $gender->gender }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nationality" class="col-md-12">Nationality<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <select class="form-control" name="nationality_id" id="nationality_id" >
                                            <option value="">Select Nationality</option>
                                            @foreach($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}" @if(old('nationality_id')==$nationality->id) selected @endif
                                                    {{$nationality->id}}>{{ $nationality->nationality }}</option>
                                            @endforeach
                                        </select>
                                        @error('nationality')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="geo_state_id" class="col-md-12">State of Origin <span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select  id="geo_state_id" name="geo_state_id" class="form-control" >
                                        <option value="">Select State</option>
                                        @foreach ($states as $data)
                                            <option value="{{ $data->id }}" @if(old('geo_state_id')==$data->id) selected @endif
                                                {{$data->id}}>{{ $data->name }}</option>

                                        @endforeach
                                    </select>
                                    @error('geo_state_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="geo_lga_id" class="col-md-12">Local Government Area<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select id="geo_lga_id"  name="geo_lga_id" class="form-control">
                                    </select>
                                    @error('geo_lga_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact_number" class="col-md-12">Contact Number<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="+234-8124638776" value="{{ old('contact_number') }}" maxlength="100" >
                                    @error('contact_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="height" class="col-md-12">Height <span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="height" name="height" placeholder="Height" value="{{ old('height') }}" >
                                    @error('height')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="blood_group" class="col-md-12">Blood Group <span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="blood_group" name="blood_group" placeholder="Blood Group" value="{{ old('blood_group') }}" >
                                    @error('blood_group')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="genotype" class="col-md-12">Genotype <span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="genotype" name="genotype" placeholder="genotype" value="{{ old('genotype') }}" >
                                    @error('genotype')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="photograph" class="col-md-12">Passport Photo</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="photograph" name="photograph" value="">
                                    @error('photograph')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="maritalstatus_id" class="col-md-12">Marital Status<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="maritalstatus_id"
                                            name="maritalstatus_id" >
                                        <option value="">Select Status</option>
                                        @foreach($mstatuses as $status)
                                            <option value="{{ $status->id }}" @if(old('maritalstatus_id')==$status->id) selected @endif
                                                {{$status->id}}>{{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                    @error('maritalstatus_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="zip_code" class="col-md-12">Zip Code <span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" value="{{ old('zip_code') }}" >
                                    @error('zip_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row gx-3">
                            <div class="form-group col-md-6">
                                <label for="residential_address" class="col-md-12">Residential Address <span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="residential_address" name="residential_address" placeholder="Residential Address" value="" maxlength="400"  >
                                        {{ old('residential_address') }}
                                    </textarea>
                                    @error('residential_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="permanent_home_address" class="col-md-12">Permanent Home Address <span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="permanent_home_address" name="permanent_home_address" placeholder="Permanent Home Address" value="" maxlength="400" >
                                        {{ old('permanent_home_address') }}
                                    </textarea>
                                    @error('permanent_home_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </fieldset>
                    <fieldset>
                        <legend>Official Data</legend>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="service_number" class="col-md-12">Service Number<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="service_number" name="service_number" placeholder="Service Number" value="{{ old('service_number') }}" maxlength="400" >
                                    @error('service_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rank_id" class="col-md-12">Rank/Grade Level<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="rank_id" id="rank_id" >
                                        <option value="">Select Rank</option>
                                        @foreach($ranks as $rank)
                                            <option value="{{ $rank->id }}" @if(old('rank_id')==$rank->id) selected @endif
                                                {{$rank->id}}>{{ $rank->rank }}</option>
                                        @endforeach
                                    </select>                                    @error('rank_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="step" class="col-md-12">Step<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="step" name="step" placeholder="Step" value="{{ old('step') }}" maxlength="400" >
                                    @error('step')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="hire_date" class="col-md-12">Hire Date<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="hire_date" name="hire_date" placeholder="Hire Date" value="{{ old('hire_date') }}" maxlength="400" >
                                    @error('hire_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="designation_id" class="col-md-12">Designation<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="designation_id" id="designation_id" >
                                        <option value="">Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{ $designation->id }}" @if(old('designation_id')==$designation->id) selected @endif
                                                {{$designation->id}}>{{ $designation->designation }}</option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="command_id" class="col-md-12">Command<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="command_id" id="command_id" >
                                        <option value="">Select Command</option>
                                        @foreach($commands as $command)
                                            <option value="{{ $command->id }}" @if(old('command_id')==$command->id) selected @endif
                                                {{$command->id}}>{{ $command->command }}</option>
                                        @endforeach
                                    </select>                                    @error('command_id')
                                    <div class="alert alert-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>
                        <div class="row gx-3">

                            <div class="form-group col-md-4">
                                <label for="office_id" class="col-md-12">Office<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="office_id" id="office_id" >
                                        <option value="">Select Office</option>
                                        @foreach($offices as $office)
                                            <option value="{{ $office->id }}" @if(old('office_id')==$office->id) selected @endif
                                                {{$office->id}}>{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('office_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="department_id" class="col-md-12">Department<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="department_id" id="department_id" >
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" @if(old('department_id')==$department->id) selected @endif
                                                {{$department->id}}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="division_id" class="col-md-12">Division<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="division_id" id="division_id" >
                                        <option value="">Select Division</option>
                                        @foreach($divisions as $division)
                                            <option value="{{ $division->id }}" @if(old('division_id')==$division->id) selected @endif
                                                {{$division->id}}>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('division_id')
                                    <div class="alert alert-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="unit_id" class="col-md-12">Unit<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="unit_id" id="unit_id" >
                                        <option value="">Select Unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" @if(old('unit_id')==$unit->id) selected @endif
                                                {{$unit->id}}>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="duty_post" class="col-md-12">Duty Post<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="duty_post" name="duty_post" placeholder="Duty Post" value="{{ old('duty_post') }}" maxlength="400" >
                                    @error('duty_post')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nin" class="col-md-12">National Identification Number</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nin" name="nin" placeholder="NIN" value="{{ old('nin') }}" maxlength="400">
                                    @error('nin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="passport_number" class="col-md-12">Passport Number</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="passport_number" name="passport_number" placeholder="Passport Number" value="{{ old('passport_number') }}" maxlength="400">
                                    @error('passport_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exit_date" class="col-md-12">Exit Date</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="exit_date" name="exit_date" placeholder="Exit Date" value="{{ old('exit_date') }}" maxlength="400">
                                    @error('exit_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Next of Kin Data</legend>
                        <div class="row gx-3">
                            <div class="form-group col-md-4">
                                <label for="next_of_kin" class="col-md-12">Next of Kin<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="next_of_kin" name="next_of_kin" placeholder="Next of Kin" value="{{ old('next_of_kin') }}" maxlength="400" >
                                    @error('next_of_kin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nok_number" class="col-md-12">Next of Kin Phone No.<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nok_number" name="nok_number" placeholder="+234-8124638776" value="{{ old('nok_number') }}" maxlength="400" >
                                    @error('nok_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nok_email" class="col-md-12">Next of Kin Email<span style="color:red; font-weight: bold;">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nok_email" name="nok_email" placeholder="Next of Kin Email" value="{{ old('nok_email') }}" maxlength="400" >
                                    @error('nok_email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>


                    </fieldset>
                    <div class="form-group">
                        <button type="submit" value="submit" class="btn btn-primary float-end" i>Save Employee</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
