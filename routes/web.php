<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('view-data', 'AuthorizationController@viewData');
Route::get('create-data', 'AuthorizationController@createData');
Route::get('edit-data', 'AuthorizationController@editData');
Route::get('update-data', 'AuthorizationController@updateData');
Route::get('delete-data', 'AuthorizationController@deleteData');

Route::resource('customer', 'CustomerController');
Route::get('customer/{id}/choose','CustomerController@choose')->name('choose_house');
Route::post('customer/store_house','CustomerController@store_house')->name('store_house');
Route::post('customer/utj','CustomerController@payUTJ')->name('customer.pay');

Route::resource('pemberkasan', 'FilingController');
Route::get('pemberkasan/{id}/isi','FilingController@filling')->name('filling');


Route::resource('akunting', 'AkuntingController');

Route::resource('blok', 'BlockController');
Route::resource('rumah', 'HouseController');

Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');

Route::get('pemasukan', 'ReportController@income')->name('income');
Route::get('pengeluaran', 'ReportController@spending')->name('spending');

Route::resource('permission', 'PermissionController');
Route::resource('kategori-transaksi', 'CategoryTransaksiController');
