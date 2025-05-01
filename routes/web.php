<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client_ProductController;
use App\Http\Controllers\Product_ClientController;
use App\Http\Controllers\Admin\PermissionController;
use App\Models\Client;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::resource('/', AdminController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->name('clients')->prefix('clients')->group(function () {
    Route::put('/import', [ClientController::class, 'import'])->name('.import');
    Route::get('/export', [ClientController::class, 'export'])->name('.export');
    Route::get('/search', [ClientController::class, 'search'])->name('.search');
});
Route::resource('/clients', ClientController::class)->middleware(['auth', 'verified'])->names('clients');

Route::middleware(['auth', 'verified'])->name('products')->prefix('products')->group(function () {
    Route::put('/import', [ProductController::class, 'import'])->name('.import');
    Route::get('/export', [ProductController::class, 'export'])->name('.export');
    Route::get('/search', [ProductController::class, 'search'])->name('.search');
});
Route::resource('/products', ProductController::class)->middleware(['auth', 'verified'])->names('products');

Route::middleware(['auth', 'verified'])->name('sellers')->prefix('sellers')->group(function () {
    Route::put('/import', [SellerController::class, 'import'])->name('.import');
    Route::get('/export', [SellerController::class, 'export'])->name('.export');
    Route::get('/search', [SellerController::class, 'search'])->name('.search');
});
Route::resource('/sellers', SellerController::class)->middleware(['auth', 'verified'])->names('sellers');

Route::middleware(['auth', 'verified'])->name('clients.products')->prefix('clients-products')->group(function () {
    Route::put('import', [Client_ProductController::class, 'import'])->name('.import');
    Route::get('export', [Client_ProductController::class, 'export'])->name('.export');
    Route::get('search', [Client_ProductController::class, 'search'])->name('.search');
});
Route::resource('/clients-products', Client_ProductController::class)->middleware(['auth', 'verified'])->names('clients.products');



require __DIR__.'/auth.php';
