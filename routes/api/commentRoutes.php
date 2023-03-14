<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::prefix("comments")->group(function (){

    Route::get('/', [CommentController::class, 'index']);
    Route::get('/{id}', [CommentController::class, 'show']);

    Route::get('findCommentsByIdeaId/{ideaId}', [CommentController::class, 'findCommentsByIdeaId']);

    Route::post('/', [CommentController::class, 'store']);
    Route::put('/{id}', [CommentController::class, 'update']);
    Route::delete('/{id}', [CommentController::class, 'destroy']);

});


