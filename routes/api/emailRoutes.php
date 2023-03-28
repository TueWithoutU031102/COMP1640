<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::post('/send-email-submitIdea', [EmailController::class, 'sentIdeaSubmitNotifyEmail'])->middleware('authJWT');
Route::post('/send-email-comment', [EmailController::class, 'sentCommentNotifyEmail'])->middleware('authJWT');
