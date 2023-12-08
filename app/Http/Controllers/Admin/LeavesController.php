<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeavesController extends Controller
{
    public function index(){
        $leaves = Leave::all();
        $employees = Employee::all();
        $leavetypes = LeaveType::all();
        $statuses = Status::all();
        return view('admin.leaves.index', compact('leaves', 'employees', 'leavetypes', 'statuses'));
    }

    public function create(){
        $data['leaves'] = Leave::all();
        $leavetypes = LeaveType::all();
        $employees = Employee::all();

        return view('leaves.create', compact(['data', 'leavetypes', 'employees']));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id' => 'required',
            'leave_type_id' => 'required',
            'leave_days'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'reason'=>'required',
            'date_applied'=> 'required',

        ]);
        $leave = Leave::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'employee_id'=> $request->employee_id,
                'leave_type_id'=> $request->leave_type_id,
                'leave_days'=> $request->leave_days,
                'start_date'=> $request->start_date,
                'end_date'=> $request->end_date,
                'reason'=> $request->reason,
                'date_applied'=> $request->date_applied,
                'status' => 1,
                'created_by' => Auth::user()->id,

            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $leave = Leave::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$leave]);
    }

    public function handlerequest(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->remarks = $request->remarks;
        $leave->status = $request->status;
        $leave->approved_by = Auth::user()->id;
        $leave->update();

        return redirect()->route('leaves.index')->with('message', 'Leave successfully updated');

    }


    public function handleleave(Request $request)
    {
        $id = $request->id;
        $leave = Leave::find($id);
        $statuses = Status::all();
        $employees = Employee::all();
        return view('admin.leaves.handlerequest', compact('leave', 'statuses', 'employees'));
    }


    public function cancelleave(Request $request, $id)
    {
        $leave = Leave::find($id);

        $leave->status = 4;
        $leave->approved_by = Auth::user()->id;
        $leave->update();
        return redirect()->route('leaves.index')->with('message', 'Leave request has been cancelled successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $leave = Leave::find($id);
        if ($leave->leaves()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Leave can not be Deleted as it has Employee assigned currently']);
        }
        $leave->delete();
        return response()->json(['status'=>200,
            'message'=>'Leave Deleted Successfully']);

    }
}
