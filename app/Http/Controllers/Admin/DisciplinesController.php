<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisciplinesController extends Controller
{
    public function index(){
        $disciplines = Discipline::all();
        $employees = Employee::all();
        return view('admin.disciplines.index', compact('disciplines',
            'employees'));
    }

    public function create(){

        $data['disciplines'] = Discipline::all();
        return view('disciplines.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id' => 'required',
            'offence_desc'=> 'required',
            'action_taken'=> 'required',
            'reported_by'=> 'required',
        ]);

        $discipline = Discipline::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'employee_id' => $request->employee_id,
                'offence_desc'=> $request->offence_desc,
                'action_taken'=> $request->action_taken,
                'reported_by'=> $request->reported_by,
                'created_by' => Auth::user()->id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $discipline = Discipline::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$discipline,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $discipline = Discipline::find($id);
        $discipline->delete();
        return response()->json(['status'=>200,
            'message'=>'Discipline Deleted Successfully']);
    }
}
