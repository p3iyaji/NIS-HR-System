<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index(){
        $offices = Office::all();
        $commands = Command::all();
        return view('admin.offices.index', compact('offices', 'commands'));
    }

    public function create(){
        $data['offices'] = Office::all();
        $commands = Command::all();
        return view('offices.create', $data, $commands);
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required',
            'command_id' => 'required',
            'location' => 'required'
        ]);
        $office = Office::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name'=> $request->name,
                'command_id'=> $request->command_id,
                'location' => $request->location,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $office = Office::find($id);
        $commands = Command::all();
        return response()->json([
            'success'=>200,
            'message'=>$office,
            'commands'=>$commands
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $office = Office::find($id);
        if ($office->departments()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Office can not be Deleted as it has Departments assigned currently']);
        }
        $office->delete();
        return response()->json(['status'=>200,
            'message'=>'Office Deleted Successfully']);
    }

}
