<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function (){
    Route::get("submission/index", [SubmissionController::class, 'index'])->name("indexSubmission");

    Route::get("submission/show/{id}", [SubmissionController::class, 'show'])->name("showSpecifiedSubmission");
});

Route::group(['prefix' => 'submission', 'middleware' => ['auth', 'admin']], function () {
    /////// SUBMISSION//
    Route::get("create", [SubmissionController::class, 'create'])->name("showCreateSubmissionForm");

    Route::post("create", [SubmissionController::class, 'store'])->name("storeSubmission");

    // sao 2 route giong nhau ntn
    // ->name() bị ghi đè đấy
    Route::get("update", [SubmissionController::class, 'update'])->name("updateSubmission");
    // Route::get("update", [SubmissionController::class, 'update'])->name("update");

    Route::get("/delete/{id}", [SubmissionController::class, 'destroy']);
});

