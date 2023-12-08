<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmpCertification;
use App\Models\Employee;
use Illuminate\Http\Request;

class CertificationsController extends Controller
{
    public function index(){
        $certifications = EmpCertification::all();
        $employees = Employee::all();
        return view('admin.certifications.index', compact('certifications',
            'employees'));
    }

    public function create(){

        $data['certifications'] = EmpCertification::all();
        return view('certifications.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id' => 'required',
            'certification_name' => 'required',
            'issuing_authority' => 'required',
            'date_obtained' => 'required',
        ]);

        $certification = EmpCertification::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'employee_id' => $request->employee_id,
                'certification_name'=> $request->certification_name,
                'issuing_authority'=> $request->issuing_authority,
                'date_obtained'=> $request->date_obtained,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $certification = EmpCertification::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$certification,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $certification = EmpCertification::find($id);
        $certification->delete();
        return response()->json(['status'=>200,
            'message'=>'Certification Deleted Successfully']);
    }
}
