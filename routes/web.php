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

Route::get('/kitchen/{kitchen_id}/items', 'ItemController@view')->where(['kitchen_id' => '[0-9]+'])->name('items.view');
Route::post('/items/create', 'ItemController@create')->name('items.create');
Route::post('/items/update', 'ItemController@update')->name('items.update');
Route::post('/items/delete', 'ItemController@delete')->name('items.delete');

Route::get('/order_lists', 'OrderListController@view')->name('order_lists.view');
Route::post('/order_lists/create', 'OrderListController@create')->name('order_lists.create');
Route::post('/order_lists/update', 'OrderListController@update')->name('order_lists.update');
Route::post('/order_lists/update_completed', 'OrderListController@update_completed')->name('order_lists.update_completed');
Route::post('/order_lists/delete', 'OrderListController@delete')->name('order_lists.delete');

Route::get('/kitchens', 'KitchensController@view')->name('kitchens.view');

Route::get('/kitchen/{kitchen_id}', 'KitchenController@view')->where(['kitchen_id' => '[0-9]+'])->name('kitchen.view');

Route::get('/suppliers_view', 'SuppliersViewController@view')->name('suppliers_view.view');

Route::get('/supplier/{supplier_id}', 'SuppliersPerspectiveController@view')->where(['supplier_id' => '[0-9]+'])
    ->name('suppliers_perspective.view');

Route::get('/download_supplier_pdf/{supplier_id}', 'SuppliersPerspectiveController@downloadPDF')->
    where(['supplier_id' => '[0-9]+'])->name('download_supplier_pdf');

Route::get('/send_supplier_email/{supplier_id}', 'SuppliersPerspectiveController@sendEmail')
    ->where(['supplier_id' => '[0-9]+'])->name('send_supplier_email');

Route::get('/kitchen/{kitchen_id}/order_lists', 'OrderListsController@view')->where(['kitchen_id' => '[0-9]+'])->name('view_order_lists.view');

Route::get('/kitchen/{kitchen_id}/order_list/{order_list_id}/kitchen_view', 'OrderListItemsController@view')
    ->where(['kitchen_id' => '[0-9]+', 'order_list_id' => '[0-9]+'])->name('order_list_items.view');
Route::get('/kitchen/{kitchen_id}/order_list/{order_list_id}/supplier_view', 'OrderListItemsController@view_grouped_by_supplier')
    ->where(['kitchen_id' => '[0-9]+', 'order_list_id' => '[0-9]+'])->name('order_list_items.view_supplier');
Route::get('/kitchen/{kitchen_id}/order_list/{order_list_id}/category_view', 'OrderListItemsController@view_categorized')
    ->where(['kitchen_id' => '[0-9]+', 'order_list_id' => '[0-9]+'])->name('order_list_items.view_category');

Route::post('/order_list_item/create', 'OrderListItemsController@create')->name('order_list_item.create');
Route::post('/order_list_item/update', 'OrderListItemsController@update')->name('order_list_item.update');
Route::post('/order_list_item/delete', 'OrderListItemsController@delete')->name('order_list_item.delete');
