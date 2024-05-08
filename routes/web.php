<?php

use App\Http\Controllers\Api\CartApiController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Storefront');
})->name('storefront');

Route::group([
    'prefix' => 'product',
], function () {
    Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
    Route::get('/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
});

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add', [CartApiController::class, 'add'])->name('api.cart.add');
    Route::delete('/remove', [CartApiController::class, 'remove'])->name('api.cart.remove');
    Route::get('/items', [CartApiController::class, 'items'])->name('api.cart.items');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
