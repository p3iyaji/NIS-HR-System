<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Division;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    public function index(){
        $units = Unit::all();
        $divisions = Division::all();
        return view('admin.units.index', compact('divisions', 'units'));
    }

    public function create(){

        $data['units'] = Unit::all();
        $divisions['divisions'] = Division::all();
        return view('units.create', $data, $divisions);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'division_id' => 'required',
        ]);
        $unit = Unit::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name'=> $request->name,
                'division_id'=> $request->division_id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $unit = Unit::find($id);
        $divisions = Division::all();
        return response()->json([
            'success'=>200,
            'message'=>$unit,
            'divisions' => $divisions]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $unit = Unit::find($id);
        $unit->delete();

        return response()->json(['success'=>200,
            'message'=>'Unit Deleted Successfully']);
    }
}
