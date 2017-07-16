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
Route::get('/users', 'UserController@index')->name('users');
Route::get('/clients', 'ClientController@index')->name('clients');
Route::get('/offices', 'OfficeController@index')->name('offices');

Route::prefix('admin')->group(function () {
    Route::resource('users', 'UserController', ['except' => ['index', 'show']]);
    Route::resource('clients', 'ClientController', ['except' => ['index', 'show']]);
    Route::resource('offices', 'OfficeController', ['except' => ['index', 'show']]);
});
