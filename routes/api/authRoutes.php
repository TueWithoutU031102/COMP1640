<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'generateJWT']);
Route::get('/getToken', [LoginController::class, 'getCurrentUserFromJWT'])->middleware('authJWT');
