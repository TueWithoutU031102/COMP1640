<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('idea/index', [IdeaController::class, 'index'])->name('indexIdea');

Route::post('idea/store', [IdeaController::class, 'store'])->name('storeIdea');

Route::post("create", [IdeaController::class, 'create'])->name("createIdea");

Route::post("idea/{idea}/like", [LikeController::class, 'store'])->name('postLike');

Route::delete("idea/{idea}/like", [LikeController::class, 'destroy'])->name('destroyLike');

