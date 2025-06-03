<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/checkout/vnpay-web', [CheckoutController::class, 'checkoutVnpayWeb']);
Route::post('/checkout/momo-web', [CheckoutController::class, 'checkoutMomoWeb']);

Route::get('/payment/vnpay/return', [PaymentController::class, 'returnVnpay'])->name('payment.vnpay.return');
Route::post('/payment/momo/notify', [PaymentController::class, 'notifyMomo']);
Route::get('/payment/momo/return', [PaymentController::class, 'returnMomo'])->name('payment.momo.return');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    // Other authenticated routes
});

Route::get('/login', function () {
    // Return login view or redirect to login controller
})->name('login');

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
 
// Admin routes group with prefix /admin
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        // Other admin routes here
    });
});

Route::get('/search', [HomeController::class, 'search'])->name('search');
