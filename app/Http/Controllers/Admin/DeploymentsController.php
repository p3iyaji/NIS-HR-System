<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deployment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeploymentsController extends Controller
{
    public function index(){
        $deployments = Deployment::all();
        $employees = Employee::all();
        return view('admin.deployments.index', compact('deployments',
            'employees'));
    }

    public function create(){

        $data['deployments'] = Deployment::all();
        return view('deployments.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id' => 'required',
            'current_location'=> 'required',
            'location_of_deployment'=> 'required',
            'deployment_date'=> 'required',
            'authorized_by'=> 'required',
            'reason' => 'required',
        ]);

        $deployment = Deployment::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'employee_id' => $request->employee_id,
                'current_location'=> $request->current_location,
                'location_of_deployment'=> $request->location_of_deployment,
                'deployment_date'=> $request->deployment_date,
                'reason'=> $request->reason,
                'authorized_by'=> $request->authorized_by,
                'created_by' => Auth::user()->id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $deployment = Deployment::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$deployment,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $deployment = Deployment::find($id);
        $deployment->delete();
        return response()->json(['status'=>200,
            'message'=>'Deployment Deleted Successfully']);
    }
}
