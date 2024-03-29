<?php

use App\Http\Controllers\AuthenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IdeaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Goodi.index');
});

Route::get('/forbiddenPage', function () {
    return view('403');
})->name("forbidden");

Route::get('/about', function () {
    return view('Goodi.about');
});

Route::get('/FAQ', function () {
    return view('Goodi.faq');
});

Route::get('/terms&condition', function () {
    return view('Goodi.terms');
});

Route::get('/login', function () {
    return view('Goodi.login');
})->name('user.login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/showFile', [IdeaController::class, 'download']);

Route::group(['middleware' => ['auth', 'user']], function () {
    Route::group([], function () {
        // ... other routes ...
        require __DIR__ . '/web/submission.php'; // include the new admin routes
    });
    Route::group([], function () {
        // ... other routes ...
        require __DIR__ . '/web/dashboard.php'; // include the new admin routes
    });
    Route::group([], function () {
        // ... other routes ...
        require __DIR__ . '/web/ideaRoutes.php'; // include the new admin routes
    });
    Route::group([], function () {
        // ... other routes ...
        require __DIR__ . '/web/categoryRoutes.php'; // include the new admin routes
    });
    Route::group([], function () {
        // ... other routes ...
        require __DIR__ . '/web/adminRoutes.php'; // include the new admin routes
    });
    Route::group([], function () {
        // ... other routes ...
        require __DIR__ . '/web/userRoutes.php'; // include the new admin routes
    });

    Route::get('/logout', [AuthenController::class, 'logout'])->name('logout');
});
