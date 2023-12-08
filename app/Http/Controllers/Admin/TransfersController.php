<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransfersController extends Controller
{
    public function index(){
        $transfers = Transfer::all();
        $employees = Employee::all();
        return view('admin.transfers.index', compact('transfers',
            'employees'));
    }

    public function create(){

        $data['transfers'] = Transfer::all();
        return view('transfers.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id' => 'required',
            'current_location'=> 'required',
            'new_location'=> 'required',
            'transfer_date'=> 'required',
            'authorized_by'=> 'required',
            'reason' => 'required',
        ]);
        $transfer = Transfer::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'employee_id' => $request->employee_id,
                'current_location'=> $request->current_location,
                'new_location'=> $request->new_location,
                'transfer_date'=> $request->transfer_date,
                'reason'=> $request->reason,
                'authorized_by'=> $request->authorized_by,
                'created_by' => Auth::user()->id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $transfer = Transfer::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$transfer,
            ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $transfer = Transfer::find($id);
        $transfer->delete();
        return response()->json(['status'=>200,
            'message'=>'Transfer Deleted Successfully']);
    }
}
