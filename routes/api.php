<?php

use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'products'], function () {
    Route::get('/{product}/variant', [ProductApiController::class, 'getVariant'])->name('api.product.variant');
    Route::post('/store', [ProductApiController::class, 'store'])->name('api.product.store');
});

