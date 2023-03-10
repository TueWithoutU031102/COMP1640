<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Carbon;

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

Route::get('/login', function () {
    return view('Goodi.login');
})->name('user.login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/showFile', [IdeaController::class, 'download']);

Route::get('index', [UserController::class, 'index'])->name('user.index');


Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/web/submission.php'; // include the new admin routes
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

Route::group([], function () {
    // ... other routes ...
    require __DIR__ . '/web/dashboardRoutes.php'; // include the new dashboard routes
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
