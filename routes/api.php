<?php

use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'products'], function () {
    Route::get('/base', [ProductApiController::class, 'getBaseProducts'])->name('api.product.base');
    Route::get('/{product}/variant', [ProductApiController::class, 'getVariant'])->name('api.product.variant');
    Route::get('/{product}/kit', [ProductApiController::class, 'getKitDetails'])->name('api.product.kit');
    Route::post('/store', [ProductApiController::class, 'store'])->name('api.product.store');
    Route::delete('/{product}/delete', [ProductApiController::class, 'destroy'])->name('api.product.destroy');
});

