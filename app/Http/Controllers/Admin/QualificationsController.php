<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmpQualification;
use Illuminate\Http\Request;

class QualificationsController extends Controller
{
    public function index(){
        $qualifications = EmpQualification::all();
        $employees = Employee::all();
        return view('admin.qualifications.index', compact('qualifications',
            'employees'));
    }

    public function create(){

        $data['qualifications'] = EmpQualification::all();
        return view('qualifications.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id' => 'required',
            'institution' => 'required',
            'certificate_obtained' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $qualification = EmpQualification::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'employee_id' => $request->employee_id,
                'institution'=> $request->institution,
                'certificate_obtained'=> $request->certificate_obtained,
                'start_date'=> $request->start_date,
                'end_date'=> $request->end_date,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $qualification = EmpQualification::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$qualification,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $qualification = EmpQualification::find($id);
        $qualification->delete();
        return response()->json(['status'=>200,
            'message'=>'Qualification Deleted Successfully']);
    }
}
