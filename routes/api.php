<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('csrfToken', [AuthenController::class, 'getCsrfToken'])->name('api.csrfToken');

Route::post('/login', [LoginController::class, 'getJWT']);

Route::post('/send-email', function (Request $request) {
    $details = [
        'to' => $request->input('to'),
        'subject' => $request->input('subject'),
        'body' => $request->input('body')
    ];

//    $email = new \App\Mail\EmailNotify();
//    $email->from('vietdq2412@gmail.com', 'Sender Name');
//    $email->to('phucchua1002@gmail.com', 'Recipient Name');
//    $email->subject('Email Notify');

    Mail::send('emails',['details'=>"haha"], function ($mail){
        $mail->subject('Goodi-Notification');
        $mail->to('phucchua1002@gmail.com', 'na');
    });

    return response()->json(['details' => $details]);
});

Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/api/commentRoutes.php';
});
Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/api/userRoutes.php';
});
