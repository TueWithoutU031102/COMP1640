<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

Route::get('/login', function () {
    return view('Goodi.login');
})->name('admin.login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::middleware(['admin'])->group(function () {
    Route::get('admin/index', function () {
        return view('Goodi/admin/index');
    })->name('admin.index');

    Route::get('admin/acc', [AdminController::class, 'acc'])->name('admin.acc');

    Route::get('admin/createAcc', function () {
        return view('Goodi/admin/user/createAcc');
    });
    Route::post('admin/createAcc', [AdminController::class, 'createAcc']);

    Route::get("admin/showAcc/{id}", [AdminController::class, 'showAcc']);

    Route::get("admin/editAcc/{id}", [AdminController::class, 'editAcc']);
    Route::post("admin/editAcc/{id}", [AdminController::class, 'updateAcc']);

    Route::post("admin/deleteAcc/{user}", [AdminController::class, 'delete']);

    Route::get("admin/submission/index", [SubmissionController::class, 'index']);

    Route::get("admin/submission/create", function () {return view('Goodi/admin/submission/create');});
    Route::post("admin/submission/create", [SubmissionController::class, 'store']);
    Route::get("admin/submission/show/{id}", [SubmissionController::class, 'show']);
});


Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
