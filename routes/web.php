<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



/* product details route */

Route::get('/shop', [HomeProductController::class, 'products'])->name('products');

Route::get('/product/{slug}', [HomeProductController::class, 'productDetail'])->name('product.detail');

Route::get('brand/{slug}', [HomeProductController::class, 'brandProduct'])->name('brand.product');
Route::get('category/{category}/{subCategory?}', [HomeProductController::class, 'categoryProduct'])->name('category.product');

/* cart routes */

Route::group(['as' => 'cart.', 'prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/{product}/add', [CartController::class, 'addToCart'])->name('add');
    Route::put('/{cartId}/update', [CartController::class, 'updateCart'])->name('update');
    Route::delete('/{cartId}/destroy', [CartController::class, 'cartItemRemove'])->name('destroy');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('clear');
});

/*------------------------------------------
All Normal Users Routes List
--------------------------------------------*/
/* checkout route */

Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    Route::post('/checkout/store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');
});

/* sslcommerz routes */

Route::post('/success', [SslCommerzPaymentController::class, 'success'])->name('payment.success');
Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->name('payment.failed');
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('payment.ipn');

/*------------------------------------------
All Admin Routes List
--------------------------------------------*/
Route::prefix('admin/')->as('admin.')->middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('product', ProductController::class);
    Route::get('/product/trash/{id}', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');

    /* get subcategory by category id with ajax */
    Route::get('/get-sub-category', [AjaxController::class, 'getSubCategory'])->name('get.subcategory');
    Route::resource('slider', SliderController::class);
    Route::get('/slider/trash/{id}', [SliderController::class, 'trash'])->name('slider.trash');
    Route::get('/slider/restore/{id}', [SliderController::class, 'restore'])->name('slider.restore');
    /* customer orders */

    Route::get('orders', [OrderController::class, 'index'])->name('pending.orders');
    Route::get('orders/approved', [OrderController::class, 'approvedOrder'])->name('approved.orders');
    Route::get('orders/show/{id}', [OrderController::class, 'showOrder'])->name('show.order');
});

/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/dashboard', [HomeController::class, 'managerDashboard'])->name('manager.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
