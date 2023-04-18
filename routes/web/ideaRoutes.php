<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\DislikeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'idea', 'middleware' => ['auth', 'user']], function () {

    Route::post('store', [IdeaController::class, 'store'])->name('storeIdea');

    Route::post("create", [IdeaController::class, 'create'])->name("createIdea");

    Route::get("show/{id}", [IdeaController::class, 'show'])->name("showIdea");

    Route::post("{ideas}/like", [LikeController::class, 'store'])->name('postLike');

    Route::delete("{ideas}/like", [LikeController::class, 'destroy'])->name('destroyLike');

    Route::post("{ideas}/dislike", [DislikeController::class, 'store'])->name('postDislike');

    Route::get("/delete/{id}", [IdeaController::class, 'destroy']);
});
