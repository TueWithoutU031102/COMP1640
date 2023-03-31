<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'qam']], function () {
    Route::get("index", [DashboardController::class, 'index']);
});
