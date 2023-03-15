<?php

use App\Http\Controllers\UserAPIController;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->group(function (){
    Route::get('/', [UserAPIController::class, 'index']);
    Route::get('/{userId}', [UserAPIController::class, 'findByid']);
    Route::post('/', [UserAPIController::class, 'store']);
    Route::put('/{id}', [UserAPIController::class, 'update']);
    Route::delete('/{id}', [UserAPIController::class, 'destroy']);
});
