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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('users', 'UserController', ['except' => ['show']]);
Route::resource('clients', 'ClientController', ['except' => ['show']]);
Route::resource('offices', 'OfficeController', ['except' => ['show']]);

Route::put('profile/{user}', 'ProfileController@update')->name('profile.update');
Route::put('users/{user}/password', 'UserPasswordController@update')->name('users.password.update');
