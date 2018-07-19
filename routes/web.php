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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/getCards', 'CardsController@show');
Route::post('/deleteWorld', 'CardsController@destroy');
Route::post('/editWorld', 'CardsController@edit');

Route::post('/addcards', 'CardsController@store')->name('formAddCards');

Route::middleware(['admin'])->group(function () {
	Route::namespace('Admin')->group(function () {
    	Route::get('/admin', 'AdminController@index')->name('admin');
	    Route::apiResource('user_roles', 'UserRolesController')->only(['index', 'show', 'update', 'destroy']);
	    Route::apiResource('roles', 'RolesController')->only(['index', 'store', 'destroy']);
	    Route::apiResource('standard_cards', 'StandardCardsController')->only(['index', 'store', 'update', 'destroy']);
	});
});
