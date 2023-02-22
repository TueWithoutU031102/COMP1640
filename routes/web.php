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

Route::get('/idea', function () {
    return view('Goodi.Admin.idea.index');
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

    Route::get('admin/createAcc', [AdminController::class, 'showFormCreateAccount']);

    Route::post('admin/createAcc', [AdminController::class, 'createAcc']);

    Route::get("admin/showAcc/{id}", [AdminController::class, 'showAcc']);

    Route::get("admin/editAcc/{id}", [AdminController::class, 'showFormEditAccount']);
    Route::post("admin/editAcc/{id}", [AdminController::class, 'updateAcc']);

    Route::post("admin/deleteAcc/{user}", [AdminController::class, 'delete']);

    /////// SUBMISSION//
    Route::get("admin/submission/index", [SubmissionController::class, 'index'])->name("listSubmission");
    Route::get("admin/submission/create", [SubmissionController::class, 'create'])->name("showCreateSubmissionForm");
    Route::post("admin/submission/create", [SubmissionController::class, 'store'])->name("storeSubmission");
    Route::get("admin/submission/show/{id}", [SubmissionController::class, 'show'])->name("showSpecifiedSubmission");

    Route::get("admin/submission/updateDueDate", [SubmissionController::class, 'updateDate'])->name("updateDate");
    Route::get("admin/submission/updateStarDate", [SubmissionController::class, 'updateDate'])->name("updateStartDate");

});

Route::prefix('/a')->group(__DIR__.'/web/submission.php');

Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
