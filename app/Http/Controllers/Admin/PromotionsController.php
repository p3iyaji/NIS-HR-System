<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionsController extends Controller
{
    public function index(){
        $promotions = Promotion::all();
        $employees = Employee::all();
        return view('admin.promotions.index', compact('promotions',
            'employees'));
    }

    public function create(){

        $data['promotions'] = Promotion::all();
        return view('promotions.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'employee_id' => 'required',
            'old_job_title' => 'required',
            'new_job_title' => 'required',
            'old_rank' => 'required',
            'new_rank' => 'required',
            'promotion_date' => 'required',
            'next_promotion_due_date' => 'required',
            'rank_duration' => 'required',
        ]);

        $promotion = Promotion::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'employee_id' => $request->employee_id,
                'old_job_title'=> $request->old_job_title,
                'new_job_title'=> $request->new_job_title,
                'old_rank'=> $request->old_rank,
                'new_rank'=> $request->new_rank,
                'promotion_date'=> $request->promotion_date,
                'next_promotion_due_date'=> $request->next_promotion_due_date,
                'rank_duration'=> $request->rank_duration,
                'created_by' => Auth::user()->id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $promotion = Promotion::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$promotion,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $promotion = Promotion::find($id);
        $promotion->delete();
        return response()->json(['status'=>200,
            'message'=>'Promotion Deleted Successfully']);
    }
}
