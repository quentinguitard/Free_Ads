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

Route::prefix('profile')->group(function(){
    Route::get('/{id}', 'UsersController@show')->name('profile.show');
    Route::get('/{id}/edit', 'UsersController@edit')->name('profile.edit');
    Route::post('/{id}/update', 'UsersController@update')->name('profile.update');
    Route::get('/{id}/destroy', 'UsersController@destroy')->name('profile.destroy');
});


Route::prefix('annonce')->group(function(){
    Route::get('/', 'AnnonceController@index')->name('annonce');
    Route::get('/new', 'AnnonceController@create')->name('annonce.new');
    Route::post('/new', 'AnnonceController@store')->name('annonce.store');
    Route::get('/{id}', 'AnnonceController@show')->name('annonce.show');
    Route::get('/{id}/edit', 'AnnonceController@edit')->name('annonce.edit');
    Route::post('/{id}/update', 'AnnonceController@update')->name('annonce.update');
    Route::get('/{id}/destroy', 'AnnonceController@destroy')->name('annonce.destroy');
    Route::post('/search', 'AnnonceController@filterSearch')->name('annonce.filter');
});

Route::get('/message/box', 'MessageController@index')->name('message.box');
Route::get('/message/new', 'MessageController@create')->name('message.new');
Route::post('/message/send', 'MessageController@store')->name('message.post');

Route::get('/image/{id}/delete', 'ImageController@destroy')->name('image.destroy');
Route::get("/confirm/{id}/{verifyToken}", 'Auth\RegisterController@confirm');