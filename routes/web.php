<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'archive'])->name('product.archive');
Route::get('/product/{product}', [ProductController::class, 'index'])->name('product.index');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    Route::post('/addToCart', [CartController::class, 'store'])->name('cart.store');

    Route::get('/cart', [CartController::class, 'getExistingCart'])->name('cart.existing');

    Route::group(['prefix' => '/checkout'], function () {
        Route::post('/cart', [CheckoutController::class, 'checkoutCart'])->name('checkout.checkoutCart');
        Route::get('/single/{product}', [CheckoutController::class, 'single'])->name('checkout.single.show');
        Route::post('/single/{product}', [CheckoutController::class, 'singleCheckout'])->name('checkout.single');
    });
});

require __DIR__ . '/auth.php';
