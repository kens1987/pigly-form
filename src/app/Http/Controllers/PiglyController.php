<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\PiglyRequest;

class PiglyController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function register2(PiglyRequest $request){
        $validated = $request->validate();
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
}
