<?php


use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function (){
    Route::get('/categories', 'CategoryController@index');
    Route::post('/categories', 'CategoryController@store');
    Route::get('/categories/{category}', 'CategoryController@show');
    Route::put('/categories/{category}', 'CategoryController@update');
    Route::delete('/categories/{category}', 'CategoryController@destroy');
});
