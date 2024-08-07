<?php

use Domain\Auth\V1\Controllers\AdminLoginController;
use Domain\Auth\V1\Controllers\AdminRegisterController;
use Domain\Auth\V1\Controllers\ForgotPasswordController;
use Domain\Auth\V1\Controllers\LogoutController;
use Domain\Auth\V1\Controllers\ResetPasswordController;
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

    Route::post('create', UserRegisterController::class)
        ->name('user.register');

    Route::post('forgot-password', ForgotPasswordController::class)
        ->name('user.forgot-password');

    Route::post('reset-password-token', ResetPasswordController::class)
        ->name('user.reset-password');

    Route::get('logout', LogoutController::class)
        ->middleware('auth:jwt')
        ->name('user.logout');
});
