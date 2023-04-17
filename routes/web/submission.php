<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function (){
    Route::get("submission/index", [SubmissionController::class, 'index'])->name("indexSubmission");

    Route::get("submission/show/{id}", [SubmissionController::class, 'show'])->name("showSpecifiedSubmission");
});

Route::group(['prefix' => 'submission', 'middleware' => ['auth', 'qam']], function () {
    /////// SUBMISSION//
    Route::get("create", [SubmissionController::class, 'create'])->name("showCreateSubmissionForm");

    Route::post("create", [SubmissionController::class, 'store'])->name("storeSubmission");

    Route::get("update", [SubmissionController::class, 'update'])->name("updateSubmission");
});

