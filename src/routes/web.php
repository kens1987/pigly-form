<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PiglyController;
use App\Http\Controllers\WeightController;

Route::get('/login', [PiglyController::class, 'login'])->name('login');
Route::post('/login', [PiglyController::class, 'store'])->name('login.submit');
Route::get('/register/step1',[PiglyController::class, 'register'])->name('register.step1.form');
Route::post('/register/step1',[PiglyController::class, 'register2'])->name('register.step1');
Route::get('/register/step2', [PiglyController::class, 'registerStep2'])->name('register.step2');
Route::post('/register/step2', [PiglyController::class, 'registerStep2Post'])->name('register.step2.submit');

Route::middleware(['auth'])->group(function (){
    Route::post('/logout',function(){
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
    Route::get('/admin',[PiglyController::class,'index'])->name('admin');
    Route::get('/weight_logs',[WeightController::class,'index'])->name('weight_logs.index');
    Route::post('/weight_logs',[WeightController::class,'store'])->name('data.store');
    // Route::get('/weight_logs/create',[PiglyController::class,'create'])->name('data.add');
    Route::get('/weight_logs/goal_setting',[WeightController::class,'goalSettingForm'])->name('goal.setting');
    Route::post('/weight_logs/goal_setting',[WeightController::class,'goalSettingUpdate'])->name('goal.setting.update');
    Route::get('/weight_logs/{weightLogId}/edit',[PiglyController::class,'edit'])->name('data.edit');
});
