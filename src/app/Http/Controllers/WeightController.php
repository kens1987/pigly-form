<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightController extends Controller
{
    public function index(Request $request){
        $userId = auth()->id();
        $form = $request->input('form');
        $to = $request->input('to');
        $latestWeightLog = WeightLog::where('user_id',$userId)->orderBy('date','desc')->first();
        $weightTarget = WeightTarget::where('user_id',$userId)->latest()->first();
        $diff = null;
        if ($latestWeightLog && $weightTarget){
            $diff = $latestWeightLog->weight - $weightTarget->target_weight;
        }
        $query = WeightLog::where('user_id',$userId);
        if ($form && $to){
            $query->whereBetween('date',[$form,$to]);
        }
        $records = $query->orderBy('date','desc')->paginate(8);
        return view('weight_logs.index',compact(
            // 'weightLogs',
            'latestWeightLog',
            'weightTarget',
            'diff',
            'records',
            'form',
            'to',
        ));
    }
    public function store(Request $request){
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric',
            'calories' => 'required|integer',
            'exercise_time' => 'required|integer',
        ]);
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->input('date'),
            'weight' => $request->input('weight'),
            'calories' => $request->input('calories'),
            'exercise_time' => $request->input('exercise_time'),
        ]);
        return redirect()->route('weight_logs.index')->with('success','データを追加しました！');
    }
    public function goalSettingForm(){
        $weightTarget = WeightTarget::where('user_id',auth()->id())->latest()->first();
        return view('weight_logs.goal_setting',compact('weightTarget'));
    }
    public function goalSettingUpdate(Request $request){
        $request->validate([
            'target_weight' => 'required|numeric',
        ]);
        WeightTarget::create([
            'user_id' => auth()->id(),
            'target_weight' => $request->input('target_weight'),
        ]);
        return redirect()->route('weight_logs.index')->with('success','目標体重を更新しました！');
    }
}
