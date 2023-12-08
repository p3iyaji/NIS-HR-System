<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Training;
use App\Models\TrainingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingsController extends Controller
{
    public function index(){
        $trainings = Training::all();
        $traininglists = TrainingList::all();
        $employees = Employee::all();
        return view('admin.trainings.index', compact('trainings', 'traininglists',
        'employees'));
    }

    public function create(){

        $data['trainings'] = Training::all();
        $traininglists['traininglists'] = TrainingList::all();
        return view('trainings.create', $data, $traininglists);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id' => 'required',
            'training_list_id' => 'required',
            'training_institute' => 'required',
            'training_location' => 'required',
            'training_duration' => 'required',
            'training_start_date' => 'required',
            'training_end_date' => 'required',
        ]);
        $training = Training::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'employee_id' => $request->employee_id,
                'training_list_id' => $request->training_list_id,
                'training_institute' => $request->training_institute,
                'training_location' => $request->training_location,
                'training_duration' => $request->training_duration,
                'training_start_date' => $request->training_start_date,
                'training_end_date' => $request->training_end_date,
                'created_by'=> Auth::user()->id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $training = Training::find($id);
        $traininglists = Office::all();
        return response()->json([
            'success'=>200,
            'message'=>$training,
            'traininglists' => $traininglists]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $training = Training::find($id);
        if ($training->employees()->count() > 0)
        {
            return response()->json([ 'status'=>405,
                'message'=>'Training can not be Deleted as it has employees assigned currently']);
        }
        $training->delete();
        return response()->json(['status'=>200,
            'message'=>'Training Deleted Successfully']);
    }

}
