<?php

use App\Http\Controllers\Client_ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Product_ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::put('/clients/import', [ClientController::class, 'import'])->middleware(['auth', 'verified'])->name('clients.import');
Route::get('/clients/export/', [ClientController::class, 'export'])->middleware(['auth', 'verified'])->name('clients.export');
Route::get('/clients/search', [ClientController::class, 'search'])->middleware(['auth', 'verified'])->name('clients.search');
Route::resource('/clients', ClientController::class)->middleware(['auth', 'verified'])->names('clients');

Route::put('/products/import', [ProductController::class, 'import'])->middleware(['auth', 'verified'])->name('products.import');
Route::get('/products/export/', [ProductController::class, 'export'])->middleware(['auth', 'verified'])->name('products.export');
Route::get('/products/search', [ProductController::class, 'search'])->middleware(['auth', 'verified'])->name('products.search');
Route::resource('/products', ProductController::class)->middleware(['auth', 'verified'])->names('products');

Route::put('/sellers/import', [SellerController::class, 'import'])->middleware(['auth', 'verified'])->name('sellers.import');
Route::get('/sellers/export/', [SellerController::class, 'export'])->middleware(['auth', 'verified'])->name('sellers.export');
Route::get('/sellers/search', [SellerController::class, 'search'])->middleware(['auth', 'verified'])->name('sellers.search');
Route::resource('/sellers', SellerController::class)->middleware(['auth', 'verified'])->names('sellers');

Route::get('/clients-products/search', [Client_ProductController::class, 'search'])->middleware(['auth', 'verified'])->name('clients.products.search');
Route::resource('/clients-products', Client_ProductController::class)->middleware(['auth', 'verified'])->names('clients.products');



require __DIR__.'/auth.php';
