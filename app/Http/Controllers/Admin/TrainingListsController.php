<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingList;
use App\Models\Types;
use Illuminate\Http\Request;

class TrainingListsController extends Controller
{
    public function index(){
        $traininglists = TrainingList::all();
        $types = Types::all();
        return view('admin.traininglists.index', compact('traininglists', 'types'));
    }

    public function create(){
        $data['traininglists'] = TrainingList::all();
        return view('traininglists.create', $data);
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'title' => 'required',
            'type' => 'required'
        ]);
        $traininglist = TrainingList::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'title'=> $request->title,
                'type' => $request->type,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $traininglist = TrainingList::find($id);
        $types = Types::all();

        return response()->json([
            'success'=>200,
            'message'=>$traininglist,
            'types'=>$types,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $traininglist = TrainingList::find($id);
        if ($traininglist->trainings()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Training List can not be Deleted as it has Trainings assigned currently']);
        }
        $traininglist->delete();
        return response()->json(['status'=>200,
            'message'=>'Training List Deleted Successfully']);
    }
}
