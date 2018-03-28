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

Route::get('/home', 'IndexController@showIndex')->name('home');
Route::get('/profile/{id}', 'UsersController@show')->name('profile.show');
Route::get('/profile/{id}/edit', 'UsersController@edit')->name('profile.edit');
Route::post('/profile/{id}/update', 'UsersController@update')->name('profile.update');
Route::get('/profile/{id}/destroy', 'UsersController@destroy')->name('profile.destroy');



Route::get("/confirm/{id}/{verifyToken}", 'Auth\RegisterController@confirm');