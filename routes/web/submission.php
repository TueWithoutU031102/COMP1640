<?php

use Illuminate\Support\Facades\Route;

Route::get("admin/Submission/index", [SubmissionController::class, 'index']);
Route::get("admin/Submission/create", function () {return view('Goodi/admin/Submission/create');});
Route::post("admin/Submission/create", [SubmissionController::class, 'store']);
Route::get("admin/Submission/show/{id}", [SubmissionController::class, 'show']);

