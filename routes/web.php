    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ProviderOrderController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\DashboardController;


    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::prefix('dashboard')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');
    Route::get('/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
    Route::post('/orders', [DashboardController::class, 'storeOrder'])->name('dashboard.order.store');
    Route::get('/products', function() {
        return view('dashboard.product'); // will create later
    })->name('dashboard.products');

    Route::get('/subscriptions', function() {
        return view('dashboard.subscriptions'); // will create later
    })->name('dashboard.subscriptions');

    Route::get('/reports', function() {
        return view('dashboard.reports'); // will create later
    })->name('dashboard.reports');

    Route::get('/profile', function() {
        return view('dashboard.profile'); // will create later
    })->name('dashboard.profile');
    });
    Route::get('/', function () {
    return view('welcome');
    });
