<?php

use App\Http\Controllers\AuthenController;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->group(function (){
    Route::get('/', [AuthenController::class, 'index']);
    Route::get('/{userId}', [AuthenController::class, 'findUserById']);
    Route::post('/', [AuthenController::class, 'store']);
    Route::put('/{id}', [AuthenController::class, 'update']);
    Route::delete('/{id}', [AuthenController::class, 'destroy']);
});
