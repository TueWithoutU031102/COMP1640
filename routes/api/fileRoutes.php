<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;


Route::get('downloadData', [IdeaController::class, 'downloadIdeaData'])->name('api.downloadData');
Route::get('downloadAllFiles/{submissionId}', [FileController::class, 'downloadAllFiles']);
