<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\MenuVariantController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderScheduleController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;


Route::get('/', function () {
    return view('pelanggan.index');
});

Route::get('/ketua', [AdminController::class, 'index'])->name('admin.index');
Route::get('/owner', [OwnerController::class, 'index'])->name('dahsboard_owner');


Route::resource('categories', CategoryController::class);
Route::resource('menus', MenuController::class);
Route::resource('menu-items', MenuItemController::class);
Route::resource('menu-variants', MenuVariantController::class);
Route::resource('orders', OrderController::class);
Route::resource('order-schedules', OrderScheduleController::class);
Route::resource('expense-categories', ExpenseCategoryController::class);
Route::resource('expenses', ExpenseController::class);





Auth::routes();

