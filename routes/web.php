<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryReportController;
use App\Http\Controllers\ItemController;
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

// routes/web.php
Route::get('/test', function() {
    return view('test');
});
