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

Route::put('users/{user}/change-password', 'UserController@changePassword')->name('users.change-password');
