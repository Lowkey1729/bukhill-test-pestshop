<?php

use Domain\Auth\V1\Controllers\AdminLoginController;
use Domain\Auth\V1\Controllers\UserLoginController;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', AdminLoginController::class)
    ->name('admin.login');

Route::post('user/login', UserLoginController::class)
    ->name('user.login');
