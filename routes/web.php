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


// Supplier Route Are Here

Route::get('/supplier/index', 'SupplierController@index')->name('supplier.index');
Route::get('/supplier/create', 'SupplierController@create')->name('supplier.create');
Route::post('/supplier/store', 'SupplierController@store')->name('supplier.add');
Route::get('/supplier/edit/{id}', 'SupplierController@edit')->name('supplier.edit');
Route::post('/supplier/update', 'SupplierController@update')->name('supplier.update');

// Customer Route Are Here

Route::get('/customer/index', 'CustomerController@index')->name('customer.index');
Route::get('/customer/create', 'CustomerController@create')->name('customer.create');
Route::post('/customer/store', 'CustomerController@store')->name('customer.add');
Route::get('/customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
Route::post('/customer/update', 'CustomerController@update')->name('customer.update');

// Customer Route Are Here

Route::get('/unit/index', 'UnitController@index')->name('unit.index');
Route::get('/unit/create', 'UnitController@create')->name('unit.create');
Route::post('/unit/store', 'UnitController@store')->name('unit.add');
Route::get('/unit/edit/{id}', 'UnitController@edit')->name('unit.edit');
Route::post('/unit/update', 'UnitController@update')->name('unit.update');

// Category Route Are Here

Route::get('/category/index', 'CategoryController@index')->name('category.index');
Route::get('/category/create', 'CategoryController@create')->name('category.create');
Route::post('/category/store', 'CategoryController@store')->name('category.add');
Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
Route::post('/category/update', 'CategoryController@update')->name('category.update');

// Product Route Are Here

Route::get('/product/index', 'ProductController@index')->name('product.index');
Route::get('/product/create', 'ProductController@create')->name('product.create');
Route::post('/product/store', 'ProductController@store')->name('product.add');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::post('/product/update', 'ProductController@update')->name('product.update');

// Purchase Route Are Here

Route::get('/purchase/index', 'PurchaseController@index')->name('purchase.index');
Route::get('/purchase/create', 'PurchaseController@create')->name('purchase.create');
Route::post('/purchase/store', 'PurchaseController@store')->name('purchase.store');
Route::get('/purchase/pending', 'PurchaseController@pendingPurchase')->name('purchase.pending');
Route::get('/purchase/approve/{id}', 'PurchaseController@approvePurchase')->name('purchase.approve');
Route::get('/purchase/delete/{id}', 'PurchaseController@delete')->name('purchase.delete');



// Invoice Route Are Here

Route::get('/invoice/index', 'InvoiceController@index')->name('invoice.index');
Route::get('/invoice/create', 'InvoiceController@create')->name('invoice.create');
Route::post('/invoice/store', 'InvoiceController@store')->name('invoice.store');
// Route::get('/invoice/check-product-stock', 'InvoiceController@checkStock')->name('check-product-stock');
Route::get('/invoice/pending-list', 'InvoiceController@pendingList')->name('invoice.pending.list');
Route::get('/invoice/approve/{id}', 'InvoiceController@approveInvoice')->name('invoice.approve');
Route::post('/invoice/approve/store/{id}', 'InvoiceController@approvalStore')->name('approval.store');
Route::get('/invoice/delete/{id}', 'InvoiceController@delete')->name('invoice.delete');
Route::get('/invoice/print/list', 'InvoiceController@printInvoiceList')->name('invoice.print.list');
Route::get('/invoice/print/{id}', 'InvoiceController@printInvoice')->name('invoice.print');


// Purchase Route Are Here

Route::get('/get-category', 'DefaultController@getCategory')->name('get-category');
Route::get('/get-product', 'DefaultController@getProduct')->name('get-product');
Route::get('/get-stock', 'DefaultController@getStock')->name('check-product-stock');