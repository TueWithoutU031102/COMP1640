<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('user')->group(function (){
    Route::get("/index", [UserController::class, 'index'])->name("userIndex");
});
