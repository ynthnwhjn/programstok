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

Route::get('/', function () {
   return view('welcome');
});

Route::get('login', [\App\Http\Controllers\AuthController::class , 'index'])
   ->name('login');
Route::post('login', [\App\Http\Controllers\AuthController::class , 'store'])
   ->name('login.store');

Route::group(['middleware' => 'auth'], function() {
   Route::resource('purchase_invoices', \App\Http\Controllers\PurchaseInvoiceController::class);
   Route::resource('sales_invoices', \App\Http\Controllers\SalesInvoiceController::class);

   Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
});
