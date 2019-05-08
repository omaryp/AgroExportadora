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

Route::get('proveedores/{prov}','ProveedorController@show')
->where('prov','[0-9]+')
->name('proveedores.show');

Route::get('proveedores/editar/{prov}','ProveedorController@edit')
->where('prov','[0-9]+')
->name('proveedores.edit');

Route::get('proveedores/nuevo','ProveedorController@create')
->name('proveedores.create');

Route::post('proveedores','ProveedorController@store');

Route::put('proveedores/{prov}','ProveedorController@update')
->where('prov','[0-9]+');

Route::delete('proveedores/{prov}','ProveedorController@destroy')
->where('prov','[0-9]+')
->name('proveedores.delete');

Route::get('proveedores/search/{rz}','ProveedorController@search')
->name('proveedores.search');

/*************************************************************************/

/**************************ORDENES DE SERVICIO****************************/
Route::get('/purchaseorders','PurchaseOrderController@index')->name('purchaseorders');

Route::post('/purchaseorders','PurchaseOrderController@store');

Route::get('/purchaseorders/nueva','PurchaseOrderController@create')
->name('purchaseorders.create');
