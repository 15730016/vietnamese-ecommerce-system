<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\ProductControllerAdmin;
use App\Http\Controllers\Admin\OrderControllerAdmin;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Web\FrontendCustomizationController;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', function () {
    return view('checkout_form');
})->name('checkout.form');

// Checkout & Payment
Route::post('/checkout/vnpay-web', [CheckoutController::class, 'checkoutVnpayWeb'])->name('checkout.vnpay');
Route::post('/checkout/momo-web', [CheckoutController::class, 'checkoutMomoWeb'])->name('checkout.momo');
Route::get('/payment/vnpay/return', [PaymentController::class, 'returnVnpay'])->name('payment.vnpay.return');
Route::post('/payment/momo/notify', [PaymentController::class, 'notifyMomo'])->name('payment.momo.notify');
Route::get('/payment/momo/return', [PaymentController::class, 'returnMomo'])->name('payment.momo.return');

// Authentication & Profile
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

use App\Http\Controllers\Admin\AuthController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Admin Profile Routes
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
        Route::get('/profile/reset-password', [\App\Http\Controllers\Admin\ProfileController::class, 'resetPassword'])->name('password.reset');
        Route::put('/profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('password.update');
        Route::get('/help', [\App\Http\Controllers\Admin\ProfileController::class, 'help'])->name('help');

        // Frontend Customization
        Route::prefix('frontend')->name('frontend.')->group(function () {
            Route::get('/general', [FrontendCustomizationController::class, 'general'])->name('general');
            Route::get('/sidebar', [FrontendCustomizationController::class, 'sidebar'])->name('sidebar');
            Route::get('/social', [FrontendCustomizationController::class, 'social'])->name('social');
            Route::get('/footer', [FrontendCustomizationController::class, 'footer'])->name('footer');
            Route::get('/contact', [FrontendCustomizationController::class, 'contact'])->name('contact');
            Route::get('/custom-css', [FrontendCustomizationController::class, 'customCss'])->name('custom_css');
            Route::get('/html-embed', [FrontendCustomizationController::class, 'htmlEmbed'])->name('html_embed');
            Route::post('/update', [FrontendCustomizationController::class, 'update'])->name('update');
        });

        // Frontend customization for Web frontend display
        Route::get('/frontend-settings', [FrontendCustomizationController::class, 'index'])->name('frontend.settings');

        // Menu Management
        Route::resource('menu', MenuController::class);

        // Multimedia
        Route::prefix('multimedia')->name('multimedia.')->group(function () {
            Route::get('/', [MultimediaController::class, 'index'])->name('index');
            Route::post('/upload', [MultimediaController::class, 'upload'])->name('upload');
            Route::delete('/{id}', [MultimediaController::class, 'destroy'])->name('destroy');
        });

        // Services
        Route::resource('services', ServiceController::class);

        // Dynamic Pages
        Route::resource('dynamic-pages', DynamicPageController::class);

        // Tickets
        Route::prefix('tickets')->name('tickets.')->group(function () {
            Route::get('/', [TicketController::class, 'index'])->name('index');
            Route::get('/{id}', [TicketController::class, 'show'])->name('show');
            Route::post('/{id}/reply', [TicketController::class, 'reply'])->name('reply');
            Route::patch('/{id}/status', [TicketController::class, 'updateStatus'])->name('update_status');
            Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');
        });

        // Team Members
        Route::resource('teams', TeamController::class);
        Route::post('teams/order', [TeamController::class, 'updateOrder'])->name('teams.order');

        // Core Resources
        Route::resource('users', UserController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('brands', AdminBrandController::class);
        Route::resource('products', ProductControllerAdmin::class);
        Route::resource('orders', OrderControllerAdmin::class);
        Route::resource('vouchers', VoucherController::class);
        Route::resource('flash-sales', FlashSaleController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('posts', PostController::class);

        // Tickets Web routes for form display and submission
        Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
        Route::post('tickets/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
        Route::patch('tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('tickets.update_status');
        Route::delete('tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    });
});
