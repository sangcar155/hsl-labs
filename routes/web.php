<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderOrderController;

Route::middleware(['auth', 'can:create,App\Models\Order'])->group(function () {
    Route::post('/provider/orders', [ProviderOrderController::class, 'store'])->name('provider.orders.store');
});

Route::get('/', function () {
    return view('welcome');
});
