<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/clients', ClientController::class)->middleware(['auth', 'verified'])->names('clients');
Route::get('/clients/search', [ClientController::class, 'search'])->middleware(['auth', 'verified'])->name('clients.search');

Route::resource('/products', ProductController::class)->middleware(['auth', 'verified'])->names('products');
Route::get('/products/search', [ProductController::class, 'search'])->middleware(['auth', 'verified'])->name('products.search');

Route::resource('/sellers', SellerController::class)->middleware(['auth', 'verified'])->names('sellers');
Route::get('/sellers/search', [SellerController::class, 'search'])->middleware(['auth', 'verified'])->name('sellers.search');



require __DIR__.'/auth.php';
