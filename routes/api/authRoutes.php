<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'loginAPI']);
Route::get('/getUserByToken', [AuthenController::class, 'getCurrentUserFromJWT'])->middleware('authJWT');
