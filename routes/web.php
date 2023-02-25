<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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

Route::get('/login', function () {
    return view('Goodi.login');
})->name('user.login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('index', [UserController::class, 'index'])->name('user.index');

Route::get("submission/index", [SubmissionController::class, 'index'])->name("indexSubmission");

Route::get("submission/show/{id}", [SubmissionController::class, 'show'])->name("showSpecifiedSubmission");

Route::get('idea/index', function () {
    return view('Goodi.Idea.index');
});

Route::get('category/index', [CategoryController::class, 'index'])->name('category.index');

Route::get('category/create', [CategoryController::class, 'formCreateCategory']);

Route::post('category/create', [CategoryController::class, 'create']);
Route::group(['prefix' => 'submission', 'middleware' => ['auth', 'admin']], function () {
    /////// SUBMISSION//
    Route::get("create", [SubmissionController::class, 'create'])->name("showCreateSubmissionForm");

    Route::post("create", [SubmissionController::class, 'store'])->name("storeSubmission");

    Route::get("update", [SubmissionController::class, 'update'])->name("update");
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    /////// ADMIN//
    Route::get('acc', [AdminController::class, 'acc'])->name('admin.acc');

    Route::get('createAcc', [AdminController::class, 'showFormCreateAccount']);

    Route::post('createAcc', [AdminController::class, 'createAcc']);

    Route::get("showAcc/{id}", [AdminController::class, 'showAcc']);

    Route::get("editAcc/{id}", [AdminController::class, 'showFormEditAccount']);

    Route::post("editAcc/{id}", [AdminController::class, 'updateAcc']);

    Route::post("deleteAcc/{user}", [AdminController::class, 'delete']);
});

Route::prefix('/a')->group(__DIR__ . '/web/submission.php');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
