<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pelanggan\ProductController;
use App\Http\Controllers\Pelanggan\CartController;
use App\Http\Controllers\Pelanggan\CheckoutController;
use App\Http\Controllers\Pelanggan\ProfileController;
use App\Http\Controllers\Pelanggan\BlogController as PelangganBlogController;

// ADMIN
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\MenuVariantController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\OrderScheduleController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\MenuAddonController;
use App\Http\Controllers\Admin\BlogController;

use App\Http\Controllers\Pelanggan\PaymentController;
use App\Http\Controllers\Admin\AdminPaymentController;

// OWNER
use App\Http\Controllers\Owner\OrderController as OwnerOrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('pelanggan.about');
})->name('about');

Route::get('/blog', [PelangganBlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [PelangganBlogController::class, 'show'])->name('blog.show');

Route::get('/feature', function () {
    return view('pelanggan.feature');
})->name('feature');

Route::get('/testimonial', function () {
    return view('pelanggan.testimonial');
})->name('testimonial');

Route::get('/contact', function () {
    return view('pelanggan.contact');
})->name('contact');

/*
|--------------------------------------------------------------------------
| HARUS LOGIN (USER)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update-ajax', [CartController::class, 'updateAjax'])->name('cart.update.ajax');
    Route::post('/cart/toggle', [CartController::class, 'toggleSelect'])->name('cart.toggle');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // ✅ TAMBAH INI — pindah ke dalam group auth & diberi name
    Route::get('/checkout/check-schedule', [CheckoutController::class, 'checkSchedule'])
        ->name('checkout.check-schedule');

    Route::get('/my-orders', [App\Http\Controllers\Pelanggan\OrderController::class, 'index'])
        ->name('my.orders');
    Route::get('/my-orders/{id}', [App\Http\Controllers\Pelanggan\OrderController::class, 'show'])
        ->name('my.orders.detail');

        // Form upload bukti bayar
    Route::get('/orders/{order}/payment', [PaymentController::class, 'create'])
        ->name('payment.create');

    // Submit bukti bayar
    Route::post('/orders/{order}/payment', [PaymentController::class, 'store'])
        ->name('payment.store');


});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('menus', MenuController::class);
        Route::resource('menu-items', MenuItemController::class);
        Route::resource('menu-variants', MenuVariantController::class);

        Route::resource('orders', AdminOrderController::class);
        Route::resource('order-schedules', OrderScheduleController::class);

        Route::resource('expense-categories', ExpenseCategoryController::class);
        Route::resource('expenses', ExpenseController::class);

        Route::resource('menu-addons', MenuAddonController::class);

        Route::resource('blogs', BlogController::class);

        // Daftar pembayaran
    Route::get('/payments', [AdminPaymentController::class, 'index'])
        ->name('payments.index');

    // Detail pembayaran
    Route::get('/payments/{payment}', [AdminPaymentController::class, 'show'])
        ->name('payments.show');

    // Konfirmasi
    Route::post('/payments/{payment}/confirm', [AdminPaymentController::class, 'confirm'])
        ->name('payments.confirm');

    // Tolak
    Route::post('/payments/{payment}/reject', [AdminPaymentController::class, 'reject'])
        ->name('payments.reject');

    });

/*
|--------------------------------------------------------------------------
| OWNER ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('owner')
    ->middleware(['auth', 'role:owner'])
    ->name('owner.')
    ->group(function () {

        Route::get('/dashboard', [OwnerController::class, 'index'])->name('dashboard');

        Route::resource('orders', OwnerOrderController::class);
    });
