<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
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



Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/api/commentRoutes.php';
});
Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/api/userRoutes.php';
});
