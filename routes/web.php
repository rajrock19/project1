<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[AuthController::class,'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('authenticate');
Route::get('user/register',[AuthController::class,'user_register'])->name('user.register');
Route::post('user/store',[UserController::class,'user_store'])->name('user.store');
Route::get('/verify-email/{id}/{token}', [UserController::class, 'verifyEmail'])->name('verify.email');

Route::middleware('jwt.auth')->group( function(){
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');  
    Route::get('/dashboard/view/',[AuthController::class,'dashboard_view'])->name('dashboard.view');  
});


Route::get('/user/{id}',[AuthController::class,'edit_user'])->name('edit.user');
Route::post('user/update/',[AuthController::class,'user_update'])->name('user.update');
Route::get('logout', [AuthController::class,'logout'])->name('logout');