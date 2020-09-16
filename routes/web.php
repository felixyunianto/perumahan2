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

Route::resource('customer', 'CustomerController')->except('show');
Route::get('customer/{id}/choose','CustomerController@choose')->name('choose_house');
Route::post('customer/store_house','CustomerController@store_house')->name('store_house');

Route::post('customer/utj','CustomerController@payUTJ')->name('customer.pay');
Route::post('customer/dp','CustomerController@payDP')->name('customer.payDP');
Route::post('customer/bank', 'CustomerController@chooseBank')->name('customer.chooseBank');
Route::post('customer/lpa/update', 'CustomerController@payLPA')->name('customer.payLPA');

Route::post('customer/fail-process','CustomerController@failProcess')->name('customer.fail');

Route::resource('pemberkasan', 'FilingController');
Route::get('pemberkasan/{id}/isi','FilingController@filling')->name('filling');


Route::post('customer/sp3/update', 'CustomerController@updateSP3')->name('update.sp3');

Route::post('customer/akad/update', 'CustomerController@updateAkad')->name('update.akad');

Route::resource('akunting', 'AkuntingController');

Route::resource('blok', 'BlockController');
Route::resource('rumah', 'HouseController');

Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');



Route::resource('permission', 'PermissionController');
Route::resource('kategori-transaksi', 'CategoryTransaksiController');

//Chart
Route::get('/incomeChart', 'ChartController@incomeChart')->name('incomeChart');
Route::get('/outcomeChart', 'ChartController@outcomeChart')->name('outcomeChart');
Route::get('/statusHouse', 'ChartController@statusHouse')->name('statusHouse');
//Report
Route::get('pemasukan', 'ReportController@income')->name('income');
Route::get('pengeluaran', 'ReportController@spending')->name('spending');
Route::get('laporan-rumah', 'ReportController@house')->name('report.house');
Route::get('laporan-laba-rugi', 'ReportController@category_transaction')->name('report.laba-rugi');
//End Report

//PDF
Route::get('pdf-income/{daterange}','pdf\PdfController@pdfIncome')->name('report.pdf-income');
Route::get('pdf-spending/{daterange}','pdf\PdfController@pdfSpending')->name('report.pdf-spending');
Route::get('pdf-house/{block_id}','pdf\PdfController@pdfHouse')->name('report.pdf-house');
Route::get('pdf-category-transaction/{daterange}', 'pdf\PdfController@pdfCategory')->name('report.pdf-category');
//EndPDF

//Excel
Route::get('excel-spending/{daterange}', 'Excel\ExcelController@excelSpending')->name('excel.spending');
Route::get('excel-income/{daterange}', 'Excel\ExcelController@excelIncome')->name('excel.income');
//EndExcel