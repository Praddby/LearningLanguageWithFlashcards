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

Route::post('/addcards', 'CardsController@store')->name('form-add-cards');

Route::group(['middleware' => ['admin']], function() {
	Route::get('/showUsers', 'Admin\AdminController@showUsers')->name('showUsers');
});