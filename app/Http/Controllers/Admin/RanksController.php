<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use Illuminate\Http\Request;

class RanksController extends Controller
{
    public function index(){
        $ranks = Rank::all();
        return view('admin.ranks.index', compact('ranks'));
    }

    public function create(){
        $data['ranks'] = Rank::all();
        return view('ranks.create', $data);
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'rank' => 'required',
            'grade_level' => 'required'
        ]);
        $Rank = Rank::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'rank'=> $request->rank,
                'grade_level' => $request->grade_level,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $Rank = Rank::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$Rank,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $Rank = Rank::find($id);
        if ($Rank->employees()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Rank can not be Deleted as it has Employees assigned currently']);
        }
        $Rank->delete();
        return response()->json(['status'=>200,
            'message'=>'Rank Deleted Successfully']);
    }
}
