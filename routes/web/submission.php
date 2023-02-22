<?php

use Illuminate\Support\Facades\Route;

Route::get("admin/submission/index", [SubmissionController::class, 'index']);
Route::get("admin/submission/create", function () {return view('Goodi/admin/submission/create');});
Route::post("admin/submission/create", [SubmissionController::class, 'store']);
Route::get("admin/submission/show/{id}", [SubmissionController::class, 'show']);

