<?php

use App\User\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function(){
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
});