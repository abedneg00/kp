<?php

use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestockController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('product', ProductController::class);
Route::resource('transaction', PenjualanController::class);
Route::resource('restock', RestockController::class);

Route::get('/', function () {
    return view('layout.conquer');
});

Route::get('/api/products/{id}', function ($id) {
    return response()->json(Products::find($id));
});

// Route::get('/laporan', [PenjualanController::class, 'laporan'])->name('laporan.index');  
// Route::get('/laporan/filter', [PenjualanController::class, 'filter'])->name('laporan.filter');  

Route::get('/laporan', [PenjualanController::class, 'report'])->name('laporan.index');


// Route::put('/transaction/sales/{id}', [PenjualanController::class, 'updateSales'])
//     ->name('transaction.updateSales');
// Route::put('/transaction/restock/{id}', [PenjualanController::class, 'updateRestock'])
//     ->name('transaction.updateRestock');
// Route::put('/transaction/stock/{id}', [PenjualanController::class, 'updateStock'])->name('transaction.updateStock');
Route::delete('restock/{id}', [RestockController::class, 'destroy'])->name('restock.destroy');  
