<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category', 'middleware' => ['auth', 'qam']], function () {
    
    Route::get('index', [CategoryController::class, 'index'])->name('category.index');

    Route::get('create', [CategoryController::class, 'formCreateCategory']);

    Route::post('create', [CategoryController::class, 'create']);

    Route::get('show/{id}', [CategoryController::class, 'show']);

    Route::get('edit/{id}', [CategoryController::class, 'formEditCategory']);

    Route::post('edit/{id}', [CategoryController::class, 'edit']);

    Route::post('delete/{category}', [CategoryController::class, 'delete']);
});
