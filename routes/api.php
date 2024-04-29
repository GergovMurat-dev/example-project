<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function () {
    Route::prefix('/products')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
    });
});

Route::controller(CategoryController::class)->group(function () {
    Route::prefix('/categories')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
    });
});
