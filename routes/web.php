<?php

use App\Http\Controllers\Web\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\BasketController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ProductController;
use Illuminate\Auth\Middleware\Authenticate;

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/', [ProductController::class, 'index'])->name('home');

Route::middleware([Authenticate::class])->group(
    static function () {
        Route::post('/basket', [BasketController::class, 'add'])->name('addToBasket');
        Route::get('/basket', [BasketController::class, 'show']);

        Route::post('/order', [OrderController::class, 'create'])->name('createOrder');
        Route::get('/order', [OrderController::class, 'index']);
        Route::delete('/order', [OrderController::class, 'delete'])->name('orders.delete');

        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    }
);
