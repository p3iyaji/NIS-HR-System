<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypesController extends Controller
{
    public function index(){
        $leavetypes = LeaveType::all();

        return view('admin.leavetypes.index', compact('leavetypes'));
    }

    public function create(){
        $data['leavetypes'] = LeaveType::all();
        return view('leavetypes.create', $data);
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'type' => 'required',

        ]);
        $leavetype = LeaveType::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'type'=> $request->type,
                'description'=> $request->description,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $leavetype = LeaveType::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$leavetype]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $leavetype = LeaveType::find($id);
        if ($leavetype->leaves()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Leave Type can not be Deleted as it has Leave assigned currently']);
        }
        $leavetype->delete();
        return response()->json(['status'=>200,
            'message'=>'LeaveType Deleted Successfully']);

    }
}
