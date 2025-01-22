<?php

use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestockController;
use App\Models\Products;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::middleware(["auth"])->group(function () {
    Route::resource('product', ProductController::class);
    Route::resource('transaction', PenjualanController::class);
    Route::resource('restock', RestockController::class);

    // Route::get('/transaction', [PenjualanController::class, 'index'])->name('transaction.index');  
    Route::get('/transaction/{id}/print', [PenjualanController::class, 'printNota'])->name('transaction.print');  


    Route::get('/', [ProductController::class, 'home'])->name('home');


    Route::get('/api/products/{id}', function ($id) {
        return response()->json(Products::find($id));
    });

    Route::get('/laporan', [PenjualanController::class, 'report'])->name('laporan.index');

    Route::delete('restock/{id}', [RestockController::class, 'destroy'])->name('restock.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
