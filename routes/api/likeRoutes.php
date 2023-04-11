<?php

use App\Http\Controllers\DislikeController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::post('/likeIdea/{idea}', [LikeController::class, 'store'])->middleware('authJWT');
Route::post('/dislikeIdea/{idea}', [DislikeController::class, 'store'])->middleware('authJWT');
