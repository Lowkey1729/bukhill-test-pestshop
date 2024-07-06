<?php

use Domain\Auth\V1\Controllers\AdminLoginController;
use Domain\Auth\V1\Controllers\AdminRegisterController;
use Domain\Auth\V1\Controllers\UserLoginController;
use Domain\Auth\V1\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::post('login', AdminLoginController::class)
        ->name('admin.login');

    Route::post('register', AdminRegisterController::class)
        ->name('admin.register');
});

Route::prefix('user')->group(function () {
    Route::post('login', UserLoginController::class)
        ->name('user.login');

    Route::post('register', UserRegisterController::class)
        ->name('user.register');
});
