<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\IdeaController;
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
Route::get('downloadData', [IdeaController::class, 'downloadData'])->name('api.downloadData');


Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/api/commentRoutes.php';
});
Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/api/userRoutes.php';
});
Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/api/authRoutes.php';
});
Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/api/emailRoutes.php';
});
