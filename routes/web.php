<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

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
Route::namespace('frontend')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
    Route::get('/product/{slug}', [ProductController::class, 'showDetails'])->name('product.details');
    
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);

    Route::get('/activate/{token}', [AuthController::class, 'activate'])->name('activate');

    Route::middleware(['auth'])->group(function(){
        Route::post('/order', [CartController::class, 'order'])->name('order');

        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
       
        Route::get('/order/{id}', [CartController::class, 'orderDetails'])->name('order.details');
        
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
   
});


