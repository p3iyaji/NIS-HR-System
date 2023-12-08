<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Command;
use App\Models\Department;
use App\Models\Deployment;
use App\Models\Designation;
use App\Models\Discipline;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\GeoLga;
use App\Models\GeoState;
use App\Models\Leave;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Office;
use App\Models\Promotion;
use App\Models\Rank;
use App\Models\Training;
use App\Models\Transfer;
use App\Models\Unit;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $genders = Gender::all();
        $nationalities = Nationality::all();
        $states = GeoState::get(["name", "id"]);
        $mstatuses = MaritalStatus::all();
        $ranks = Rank::all();
        $designations = Designation::all();
        $commands = Command::all();
        $offices = Office::all();
        $departments = Department::all();
        $divisions = Division::all();
        $units = Unit::all();
        return view('admin.employees.create', compact('genders', 'nationalities',
            'states', 'mstatuses', 'ranks', 'designations', 'commands', 'offices', 'departments',
        'divisions', 'units'));
    }

    public function fetchCities(Request $request)
    {
        $data['cities'] = GeoLga::where("geo_state_id",$request->geo_state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function store(EmployeeStoreRequest $request)
    {
        if ($request->hasFile('photograph')) {
            $filenamewithExt = $request->file('photograph')->getClientOriginalName();
            $imgPath = $request->file('photograph')->storeAs('public/imgs', $filenamewithExt);
            $employee = new Employee;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->other_names = $request->other_names;
            $employee->date_of_birth = $request->date_of_birth;
            $employee->gender_id = $request->gender_id;
            $employee->nationality_id = $request->nationality_id;
            $employee->contact_number = $request->contact_number;
            $employee->geo_state_id = $request->geo_state_id;
            $employee->geo_lga_id = $request->geo_lga_id;
            $employee->rank_id = $request->rank_id;
            $employee->step = $request->step;
            $employee->command_id = $request->command_id;
            $employee->zip_code = $request->zip_code;
            $employee->hire_date = $request->hire_date;
            $employee->office_id = $request->office_id;
            $employee->department_id = $request->department_id;
            $employee->division_id = $request->division_id;
            $employee->unit_id = $request->unit_id;
            $employee->designation_id = $request->designation_id;
            $employee->blood_group = $request->blood_group;
            $employee->height = $request->height;
            $employee->genotype = $request->genotype;
            $employee->duty_post = $request->duty_post;
            $employee->maritalstatus_id = $request->maritalstatus_id;
            $employee->next_of_kin = $request->next_of_kin;
            $employee->nok_number = $request->nok_number;
            $employee->nok_email = $request->nok_email;
            $employee->permanent_home_address = $request->permanent_home_address;
            $employee->residential_address = $request->residential_address;
            $employee->service_number = $request->service_number;
            $employee->nin = $request->nin;
            $employee->passport_number = $request->passport_number;
            $employee->exit_date = $request->exit_date;
            $employee->photograph = $filenamewithExt;

            $employee->save();
        }else{
            //dd($request->all());
            $employee = Employee::create($request->validated());
        }

        return redirect()->route('employees.index')->with('message', 'Employee Record successfully added');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        $genders = Gender::all();
        $nationalities = Nationality::all();
        $states = GeoState::get(["name", "id"]);
        $mstatuses = MaritalStatus::all();
        $ranks = Rank::all();
        $designations = Designation::all();
        $commands = Command::all();
        $offices = Office::all();
        $departments = Department::all();
        $divisions = Division::all();
        $units = Unit::all();
        return view('admin.employees.edit', compact('employee', 'genders', 'nationalities',
            'states', 'mstatuses', 'ranks', 'designations', 'commands', 'offices', 'departments',
            'divisions', 'units'));
    }

    public function update(EmployeeStoreRequest $request, $id)
    {
        if ($request->hasFile('photograph')) {
            $filenamewithExt = $request->file('photograph')->getClientOriginalName();
            $imgPath = $request->file('photograph')->storeAs('public/imgs', $filenamewithExt);

            $employee = Employee::find($id);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->other_names = $request->other_names;
            $employee->date_of_birth = $request->date_of_birth;
            $employee->gender_id = $request->gender_id;
            $employee->nationality_id = $request->nationality_id;
            $employee->contact_number = $request->contact_number;
            $employee->geo_state_id = $request->geo_state_id;
            $employee->geo_lga_id = $request->geo_lga_id;
            $employee->rank_id = $request->rank_id;
            $employee->step = $request->step;
            $employee->command_id = $request->command_id;
            $employee->zip_code = $request->zip_code;
            $employee->hire_date = $request->hire_date;
            $employee->office_id = $request->office_id;
            $employee->department_id = $request->department_id;
            $employee->division_id = $request->division_id;
            $employee->unit_id = $request->unit_id;
            $employee->designation_id = $request->designation_id;
            $employee->blood_group = $request->blood_group;
            $employee->height = $request->height;
            $employee->genotype = $request->genotype;
            $employee->duty_post = $request->duty_post;
            $employee->maritalstatus_id = $request->maritalstatus_id;
            $employee->next_of_kin = $request->next_of_kin;
            $employee->nok_number = $request->nok_number;
            $employee->nok_email = $request->nok_email;
            $employee->permanent_home_address = $request->permanent_home_address;
            $employee->residential_address = $request->residential_address;
            $employee->service_number = $request->service_number;
            $employee->nin = $request->nin;
            $employee->passport_number = $request->passport_number;
            $employee->exit_date = $request->exit_date;
            $employee->photograph = $filenamewithExt;

            $employee->update();
        }else{
            //dd($request->all());
            $employee = Employee::find($id);
            $employee->update($request->validated());
        }

        return redirect()->route('employees.index')->with('message', 'Employee Record successfully Updated');

    }

    public function show($id)
    {
        $employee = Employee::find($id);
        $leaves = Leave::all()->where('employee_id', $id);
        $trainings = Training::all()->where('employee_id', $id);
        $transfers = Transfer::all()->where('employee_id', $id);
        $disciplines = Discipline::all()->where('employee_id', $id);
        $promotions = Promotion::all()->where('employee_id', $id);
        $deployments = Deployment::all()->where('employee_id', $id);

        return view('admin.employees.show', compact('employee', 'leaves', 'trainings',
        'transfers', 'disciplines', 'promotions', 'deployments'));
    }





}
