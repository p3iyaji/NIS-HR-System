<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationsController extends Controller
{
    public function index(){
        $designations = Designation::all();

        return view('admin.designations.index', compact('designations'));
    }

    public function create(){
        $data['designations'] = Designation::all();
        return view('designations.create', $data);
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'designation' => 'required',

        ]);
        $designation = Designation::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'designation'=> $request->designation,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $designation = Designation::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$designation]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $designation = Designation::find($id);
        if ($designation->employees()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Designation can not be Deleted as it has Employees assigned currently']);
        }
        $designation->delete();
        return response()->json(['status'=>200,
            'message'=>'Designation Deleted Successfully']);

    }
}
