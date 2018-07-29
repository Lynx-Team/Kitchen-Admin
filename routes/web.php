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
Route::post('/users/update_profile', 'UserController@update_profile')->name('users.update_profile');
Route::post('/users/change_password', 'UserController@change_password')->name('users.change_password');

Route::get('/suppliers', 'SupplierController@view')->name('suppliers.view');
Route::post('/suppliers/create', 'SupplierController@create')->name('suppliers.create');
Route::post('/suppliers/update', 'SupplierController@update')->name('suppliers.update');
Route::post('/suppliers/delete', 'SupplierController@delete')->name('suppliers.delete');

Route::get('/item_categories', 'ItemCategoryController@view')->name('item_categories.view');
Route::post('/item_categories/create', 'ItemCategoryController@create')->name('item_categories.create');
Route::post('/item_categories/update', 'ItemCategoryController@update')->name('item_categories.update');
Route::post('/item_categories/delete', 'ItemCategoryController@delete')->name('item_categories.delete');

Route::get('/items', 'ItemController@view')->name('items.view');
Route::post('/items/create', 'ItemController@create')->name('items.create');
Route::post('/items/update', 'ItemController@update')->name('items.update');
Route::post('/items/delete', 'ItemController@delete')->name('items.delete');

Route::get('/kitchens', 'KitchensController@view')->name('kitchens.view');
