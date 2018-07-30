<?php

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
    return view('welcome');
});

Auth::routes();


//users
Route::middleware(['auth'])->group(function () {
    Route::namespace('User')->group(function () {
        Route::get('home', 'UserController@index')->name('home');
        Route::apiResource('user_cards', 'UserCardsController')->only(['index', 'store', 'update', 'destroy']);
    });
});

//admin
Route::middleware(['admin'])->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::get('admin', 'AdminController@index')->name('admin');
        Route::apiResource('user_roles', 'UserRolesController')->only(['index', 'show', 'update', 'destroy']);
        Route::apiResource('roles', 'RolesController')->only(['index', 'store', 'destroy']);
        Route::apiResource('standard_cards', 'StandardCardsController')->only(['index', 'store', 'update', 'destroy']);
    });
});
