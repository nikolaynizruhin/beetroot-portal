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

Route::resource('users', 'UserController', ['except' => ['show']]);
Route::resource('clients', 'ClientController', ['except' => ['show']]);
Route::resource('offices', 'OfficeController', ['except' => ['show']]);

Route::put('users/{user}/password', 'UserPasswordController@update')->name('users.password.update');
Route::put('users/{user}/avatar', 'UserAvatarController@update')->name('users.avatar.update');
