<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/Idea', function () {
    return view('Goodi.Admin.Idea.index');
});

Route::get('/login', function () {
    return view('Goodi.login');
})->name('user.login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('index', [UserController::class, 'index'])->name('user.index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('acc', [AdminController::class, 'acc'])->name('admin.acc');

    Route::get('createAcc', [AdminController::class, 'showFormCreateAccount']);

    Route::post('createAcc', [AdminController::class, 'createAcc']);

    Route::get("showAcc/{id}", [AdminController::class, 'showAcc']);

    Route::get("editAcc/{id}", [AdminController::class, 'showFormEditAccount']);

    Route::post("editAcc/{id}", [AdminController::class, 'updateAcc']);

    Route::post("deleteAcc/{user}", [AdminController::class, 'delete']);

    /////// SUBMISSION//
    Route::get("Submission/index", [SubmissionController::class, 'index'])->name("listSubmission");
    Route::get("Submission/create", [SubmissionController::class, 'create'])->name("showCreateSubmissionForm");
    Route::post("Submission/create", [SubmissionController::class, 'store'])->name("storeSubmission");
    Route::get("Submission/show/{id}", [SubmissionController::class, 'show'])->name("showSpecifiedSubmission");
    Route::get("Submission/update", [SubmissionController::class, 'update'])->name("update");
});

Route::prefix('/a')->group(__DIR__ . '/web/submission.php');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
