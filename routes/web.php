<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ HomeController::class , 'home' ] )->name('home');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.show');

Route::post('/checkout', [ CheckoutController::class, 'checkout' ])->name('checkout');


Route::post('/apply-coupon', [ CouponController::class, 'applyCoupon' ])->name('coupons.apply');

Auth::routes();

