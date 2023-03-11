<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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
