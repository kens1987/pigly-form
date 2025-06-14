<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\PiglyRequest;

class PiglyController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function register2(PiglyRequest $request){
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        session(['registered_user_id' => $user->id]);
        return redirect()->route('register.step2');
    }
    public function registerStep2(){
        return view('auth.register2');
    }
    public function login() {
        return view('auth.login');
    }
    public function store(PiglyRequest $request){
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/weight_logs');
        }
        throw ValidationException::withMessages([
            'email' => ['メールアドレスまたはパスワードが正しくありません。'],
        ]);
    }
    public function index(){
        $userId = auth()->id();
        $latestWeightLog = WeightLog::where('user_id',$userId)->orderBy('date','desc')->first();
        $weightTarget = WeightTarget::where('user_id',$userId)->latest()->first();
        $diff = null;
        if ($latestWeightLog && $weightTarget) {
            $diff = $latestWeightLog->weight - $weightTarget->target_weight;
        }
        $records = WeightLog::where('user_id',$userId)->orderBy('date','desc')->paginate(8);
        return view('admin',compact('latestWeightLog','weightTarget','diff','records'));
    }
    public function create() {
        return view('weight_logs.create');
    }
    public function registerStep2Post(PiglyRequest $request) {
        $validated = $request->validated();
        $userId = session('registered_user_id');
        if(!$userId) {
            return redirect()->route('register.step1.form')->withErrors('ユーザー情報が見つかりません。');
        }
        WeightLog::create([
            'user_id' => $userId,
            'weight' => $validated['weight'],
            'calories' => 0,
            'exercise_time' => 0,
            'date' => now(),
        ]);
        WeightTarget::create([
            'user_id' => $userId,
            'target_weight' => $validated['target_weight'],
        ]);
        $user = \App\Models\User::find($userId);
        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->forget('registered_user_id');
        return redirect()->route('admin');
    }
}
