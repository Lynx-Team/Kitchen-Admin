<?php

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

Route::get('/kitchen/{kitchen_id}/suppliers', 'SupplierController@view')
    ->where(['kitchen_id' => '[0-9]+'])->name('suppliers.view');
Route::post('/suppliers/create', 'SupplierController@create')->name('suppliers.create');
Route::post('/suppliers/update', 'SupplierController@update')->name('suppliers.update');
Route::post('/suppliers/delete', 'SupplierController@delete')->name('suppliers.delete');

Route::get('/kitchen/{kitchen_id}/product_categories', 'ItemCategoryController@view')
    ->where(['kitchen_id' => '[0-9]+'])->name('item_categories.view');
Route::post('/product_categories/create', 'ItemCategoryController@create')->name('item_categories.create');
Route::post('/product_categories/update', 'ItemCategoryController@update')->name('item_categories.update');
Route::post('/product_categories/delete', 'ItemCategoryController@delete')->name('item_categories.delete');

Route::get('/kitchen/{kitchen_id}/items', 'ItemController@view')->where(['kitchen_id' => '[0-9]+'])->name('items.view');
Route::post('/items/create', 'ItemController@create')->name('items.create');
Route::post('/items/update', 'ItemController@update')->name('items.update');
Route::post('/items/delete', 'ItemController@delete')->name('items.delete');

Route::get('/order_lists', 'OrderListController@view')->name('order_lists.view');
Route::post('/order_lists/create', 'OrderListController@create')->name('order_lists.create');
Route::post('/order_lists/update', 'OrderListController@update')->name('order_lists.update');
Route::post('/order_lists/finalize', 'OrderListController@finalize')->name('order_lists.finalize');
Route::post('/order_lists/delete', 'OrderListController@delete')->name('order_lists.delete');
Route::post('/order_lists/reset', 'OrderListController@reset')->name('order_lists.reset');

Route::get('/kitchens', 'KitchensController@view')->name('kitchens.view');
Route::post('/add_new_kitchen_user', 'KitchensController@add_new_kitchen')->name('kitchens.add_new_kitchen');
Route::get('/kitchen/{kitchen_id}', 'KitchenController@view')->where(['kitchen_id' => '[0-9]+'])->name('kitchen.view');
Route::get('/kitchen/{kitchen_id}/order_lists', 'OrderListsController@view')->where(['kitchen_id' => '[0-9]+'])->name('view_order_lists.view');
Route::match(
    ['get', 'post'],
    '/kitchen/{kitchen_id}/order_list/{order_list_id}/kitchen_view', 'OrderListItemsController@view'
)->where(['kitchen_id' => '[0-9]+', 'order_list_id' => '[0-9]+'])->name('order_list_items.view');
Route::get('/kitchen/{kitchen_id}/order_list/{order_list_id}/supplier_view', 'OrderListItemsController@view_grouped_by_supplier')
    ->where(['kitchen_id' => '[0-9]+', 'order_list_id' => '[0-9]+'])->name('order_list_items.view_supplier');
Route::get('/kitchen/{kitchen_id}/order_list/{order_list_id}/category_view', 'OrderListItemsController@view_categorized')
    ->where(['kitchen_id' => '[0-9]+', 'order_list_id' => '[0-9]+'])->name('order_list_items.view_category');

Route::post('/order_list_item/create', 'OrderListItemsController@create')->name('order_list_item.create');
Route::post('/order_list_item/update', 'OrderListItemsController@update')->name('order_list_item.update');
Route::post('/order_list_item/delete', 'OrderListItemsController@delete')->name('order_list_item.delete');

Route::get('/order_list_items/{order_list_id}/download_pdf', 'OrderListItemsController@downloadPDF')
    ->where(['order_list_id' => '[0-9]+'])->name('order_list_items.download_pdf');

Route::get('/order_list/{order_list_id}/supplier/{supplier_id}/download_pdf', 'OrderListItemsController@downloadPDF')
    ->where([
        'order_list_id' => '[0-9]+', 'supplier_id' => '[0-9]+'
    ])->name('supplier_order_list.download_pdf');

Route::get('/order_list/{order_list_id}/supplier/{supplier_id}/send_email', 'OrderListItemsController@sendEmail')
    ->where([
        'supplier_id' => '[0-9]+', 'order_list_id' => '[0-9]+',
    ])->name('supplier_order_list.send_email');

Route::get('/order_list_items/{order_list_id}/send_email', 'OrderListItemsController@sendEmail')
    ->where(['order_list_id' => '[0-9]+'])->name('order_list_items.send_email');

Route::get('/download_backup', 'BackupController@download')->name('backup.download');

Route::get('/mail_setup', 'MailSetupController@view')->name('mail_setup.view');
Route::post('/update_mail_config', 'MailSetupController@update')->name('mail_setup.update');

Route::get('/kitchen/{kitchen_id}/profile', 'KitchenProfileController@view')->where(['kitchen_id' => '[0-9]+'])->name('kitchen_profile.view');
Route::post('/kitchen/{kitchen_id}/update_profile', 'KitchenProfileController@update')->where(['kitchen_id' => '[0-9]+'])->name('kitchen_profile.update');

Route::get('/kitchen/{kitchen_id}/reporting', 'HistoryOrderListController@view')->where(['kitchen_id' => '[0-9]+'])->name('reporting.view');
Route::get('/kitchen/{kitchen_id}/report/{report_id}', 'HistoryOrderListItemsController@view')
    ->where(['kitchen_id' => '[0-9]+', 'report_id' => '[0-9]+'])->name('reporting_items.view');