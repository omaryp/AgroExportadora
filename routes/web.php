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
})
->name('inicio');

/*******************************PROVEEDORES*******************************/
Route::get('proveedores','ProveedorController@index')->name('proveedores');

Route::get('/proveedores/{prov}','ProveedorController@show')
->where('prov','[0-9]+')
->name('proveedores.show');

Route::get('/proveedores/editar/{prov}','ProveedorController@edit')
->where('prov','[0-9]+')
->name('proveedores.edit');

Route::get('/proveedores/nuevo','ProveedorController@create')
->name('proveedores.create');

Route::post('/proveedores','ProveedorController@store');

Route::put('/proveedores/{prov}','ProveedorController@update')
->where('prov','[0-9]+');

Route::delete('/proveedores/{prov}','ProveedorController@destroy')
->where('prov','[0-9]+')
->name('proveedores.delete');

Route::get('/proveedores/search/{rz}','ProveedorController@search')
->name('proveedores.search');
/*************************************************************************/

/**************************ORDENES DE COMPRA****************************/
Route::get('/purchaseorders','PurchaseOrderController@index')->name('purchaseorders');

Route::post('/purchaseorders','PurchaseOrderController@store');

Route::get('/purchaseorders/nueva','PurchaseOrderController@create')
->name('purchaseorders.create');

Route::get('/purchaseorders/{codigo}','PurchaseOrderController@show')
->where('codigo','[0-9]+')
->name('purchaseorders.show');

Route::get('/purchaseorders/editar/{codigo}','PurchaseOrderController@edit')
->where('codigo','[0-9]+')
->name('purchaseorders.edit');

Route::put('/purchaseorders/{codigo}','PurchaseOrderController@update')
->name('purchaseorders.update');

Route::get('/purchaseorders/search/{rz}','PurchaseOrderController@search')
->name('proveedores.search');
/*************************************************************************/

/***********************ORDENES DE COMPRA DETALLE*************************/
Route::post('/purchaseordersdetail','PurchaseOrderDetailController@store');

/*************************************************************************/

/**************************COMPROBANTES***********************************/
Route::get('vouchers','VoucherController@index')->name('vouchers');

Route::get('/vouchers/create','VoucherController@create')
->name('vouchers.create');

Route::post('/vouchers','VoucherController@store');

Route::put('/vouchers/{id}','VoucherController@update')
->where('id','[0-9]+')
->name('vouchers.update');

Route::get('/vouchers/{id}','VoucherController@show')
->where('id','[0-9]+')
->name('vouchers.show');

Route::get('/vouchers/edit/{id}','VoucherController@edit')
->where('id','[0-9]+')
->name('vouchers.edit');

Route::delete('/vouchers/{id}','VoucherController@destroy')
->where('id','[0-9]+')
->name('vouchers.delete');

Route::get('/vouchers/search/{rz}','VoucherController@search')
->name('vouchers.search');

/*************************************************************************/


/**************************CRONOGRAMA*COMPROBANTES************************/
Route::post('/chronogramvoucher','ChronogramVoucherController@store');

/*************************************************************************/


/**************************COMPROBANTES***********************************/
Route::get('payments','PaymentController@index')->name('payments');

Route::get('/payments/create','PaymentController@create')
->name('payments.create');

Route::post('/payments','PaymentController@store');

Route::get('/payments/{id}','PaymentController@show')
->where('id','[0-9]+')
->name('payments.show');

Route::get('/payments/edit/{id}','PaymentController@edit')
->where('id','[0-9]+')
->name('payments.edit');

Route::delete('/payments/{id}','PaymentController@destroy')
->where('id','[0-9]+')
->name('payments.delete');

Route::get('/payments/tipo/{codigo}','PaymentController@tipo')
->where('codigo','[0-9]+')
->name('payments.tipo');

Route::get('/payments/datos/{codigo}','PaymentController@datos')
->where('codigo','[0-9]+')
->name('payments.datos');

Route::get('/payments/comprobante/{codigo}', 'PaymentController@comprobante')
->where('codigo','[0-9]+');

Route::get('/payments/detraccion/{codigo}', 'PaymentController@detret')
->where('codigo','[0-9]+');

Route::get('/payments/retencion/{codigo}', 'PaymentController@detret')
->where('codigo','[0-9]+');

/*************************************************************************/