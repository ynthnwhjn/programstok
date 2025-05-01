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

Route::get('login', [\App\Http\Controllers\AuthController::class, 'index'])
   ->name('login');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'store'])
   ->name('login.store');

Route::group(['middleware' => 'auth'], function () {
   Route::resource('products', \App\Http\Controllers\ProductController::class);
   Route::resource('customers', \App\Http\Controllers\CustomerController::class);
   Route::resource('purchase_invoices', \App\Http\Controllers\PurchaseInvoiceController::class);
   Route::resource('sales_invoices', \App\Http\Controllers\SalesInvoiceController::class);

   Route::get('laporan_stok_barang', [\App\Http\Controllers\LaporanStokBarangController::class, 'index'])
      ->name('laporan_stok_barang.index');
   Route::get('laporan_stok_barang/datasource', [\App\Http\Controllers\LaporanStokBarangController::class, 'datasource'])
      ->name('laporan_stok_barang.datasource');
   Route::get('laporan_stok_barang/pracetak', [\App\Http\Controllers\LaporanStokBarangController::class, 'pracetak'])
      ->name('laporan_stok_barang.pracetak');

   Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

   Route::get('/', function () {
      return view('welcome');
   });
});
