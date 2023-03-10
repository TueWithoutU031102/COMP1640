<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'idea', 'middleware' => ['auth', 'staff']], function () {

    Route::get('index', [IdeaController::class, 'index'])->name('indexIdea');

    Route::post('store', [IdeaController::class, 'store'])->name('storeIdea');

    Route::post("create", [IdeaController::class, 'create'])->name("createIdea");

    Route::post("{idea}/like", [LikeController::class, 'store'])->name('postLike');

    Route::delete("{idea}/like", [LikeController::class, 'destroy'])->name('destroyLike');

    Route::post("{idea}/dislike", [LikeController::class, 'store'])->name('postDislike');

    Route::delete("{idea}/dislike", [LikeController::class, 'destroy'])->name('destroyDislike');
});
