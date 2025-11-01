<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProviderOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

     Route::prefix('dashboard')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');
    Route::get('/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
    Route::post('/orders', [DashboardController::class, 'store'])->name('dashboard.order.store');
    Route::get('/products', function() {
        return view('dashboard.product'); // will create later
    })->name('dashboard.products');
     });

