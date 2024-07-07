<?php

use Domain\Product\V1\Controllers\CreateProductController;
use Domain\Product\V1\Controllers\UpdateProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {

    Route::middleware('auth:jwt')->group(function () {

        Route::post('create', CreateProductController::class)
            ->name('product.create');

        Route::post('update/{uuid}', UpdateProductController::class)
            ->name('product.update');

    });
});
