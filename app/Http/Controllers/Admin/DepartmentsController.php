<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Office;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index(){
        $departments = Department::all();
        $offices = Office::all();
        return view('admin.departments.index', compact('departments', 'offices'));
    }

    public function create(){

        $data['departments'] = Department::all();
        $offices['offices'] = Office::all();
        return view('departments.create', $data, $offices);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);
        $department = Department::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name'=> $request->name,
                'description'=> $request->description,
                'office_id'=> $request->office_id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $department = Department::find($id);
        $offices = Office::all();
        return response()->json([
            'success'=>200,
            'message'=>$department,
            'offices' => $offices]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $department = Department::find($id);
        if ($department->divisions()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Department can not be Deleted as it has Divisions assigned currently']);
        }
        $department->delete();
        return response()->json(['status'=>200,
            'message'=>'Department Deleted Successfully']);
    }


}
