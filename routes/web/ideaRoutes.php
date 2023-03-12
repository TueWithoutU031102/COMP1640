<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\DislikeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'idea', 'middleware' => ['auth', 'user']], function () {

    Route::get('index', [IdeaController::class, 'index'])->name('indexIdea');

    Route::post('store', [IdeaController::class, 'store'])->name('storeIdea');

    Route::post("create", [IdeaController::class, 'create'])->name("createIdea");

    Route::post("{idea}/like", [LikeController::class, 'store'])->name('postLike');

    Route::delete("{idea}/like", [LikeController::class, 'destroy'])->name('destroyLike');

    Route::post("{idea}/dislike", [DislikeController::class, 'store'])->name('postDislike');

    Route::delete("{idea}/dislike", [DislikeController::class, 'destroy'])->name('destroyDislike');
});
