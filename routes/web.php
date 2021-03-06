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
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/users', 'UserController@view')->name('users.view');
Route::post('/users/create', 'UserController@create')->name('users.create');
Route::post('/users/update', 'UserController@update')->name('users.update');
Route::post('/users/delete', 'UserController@delete')->name('users.delete');

Route::get('/suppliers', 'SupplierController@view')->name('suppliers.view');
Route::post('/suppliers/create', 'SupplierController@create')->name('suppliers.create');
Route::post('/suppliers/update', 'SupplierController@update')->name('suppliers.update');
Route::post('/suppliers/delete', 'SupplierController@delete')->name('suppliers.delete');
