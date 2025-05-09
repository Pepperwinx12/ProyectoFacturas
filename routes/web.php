<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryReportController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategoryController::class);

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

Route::resource('suppliers', SupplierController::class);

Route::resource('customers', CustomerController::class);

Route::get('/reports/categories', [CategoryReportController::class, 'index'])->name('reports.categories');

Route::resource('items', ItemController::class);



Route::prefix('sales')->group(function() {
    // Ruta para ver la lista de ventas
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');

    // Ruta para ver el formulario de crear venta
    Route::get('create', [SaleController::class, 'create'])->name('sales.create');

    // Ruta para almacenar una nueva venta
    Route::post('/', [SaleController::class, 'store'])->name('sales.store');

    // Ruta para actualizar una venta existente
    Route::put('{sale}', [SaleController::class, 'update'])->name('sales.update');

    // Ruta para eliminar una venta
    Route::delete('{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');


    // routes/web.php


Route::get('sales/{sale}/invoice', [SaleController::class, 'generateInvoice'])->name('sales.invoice');
 
});



// routes/web.php
Route::get('/test', function() {
    return view('test');
});



