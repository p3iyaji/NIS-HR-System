<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use Illuminate\Http\Request;

class CommandsController extends Controller
{
    public function index(){
        $commands = Command::all();

        return view('admin.commands.index', compact('commands'));
    }

    public function create(){
        $data['commands'] = Command::all();
        return view('commands.create', $data);
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'command' => 'required',

        ]);
        $command = Command::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'command'=> $request->command,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $command = Command::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$command]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $command = Command::find($id);
        if ($command->offices()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Command can not be Deleted as it has offices assigned currently']);
        }
            $command->delete();
            return response()->json(['status'=>200,
                'message'=>'Command Deleted Successfully']);

    }

}
