<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PiglyController;

Route::get('/register/step1',[PiglyController::class, 'register'])->name('register.step1.form');
Route::post('/register/step1',[PiglyController::class, 'register2'])->name('register.step1');
Route::get('/register/step2', [PiglyController::class, 'registerStep2'])->name('register.step2');
