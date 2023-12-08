<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionsController extends Controller
{
    public function index(){
        $divisions = Division::all();
        $departments = Department::all();
        return view('admin.divisions.index', compact('departments', 'divisions'));
    }

    public function create(){

        $data['divisions'] = Division::all();
        $departments['departments'] = Department::all();
        return view('divisions.create', $data, $departments);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'department_id' => 'required',
        ]);
        $division = Division::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name'=> $request->name,
                'department_id'=> $request->department_id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $division = Division::find($id);
        $departments = Department::all();
        return response()->json([
            'success'=>200,
            'message'=>$division,
            'departments' => $departments]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $division = Division::find($id);
        if ($division->units()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Division can not be Deleted as it has Units assigned currently']);
        }
        $division->delete();
        return response()->json(['status'=>200,
            'message'=>'Division Deleted Successfully']);
    }
}
