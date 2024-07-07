<?php

use Domain\User\V1\Controllers\DeleteAccountController;
use Domain\User\V1\Controllers\EditUserController;
use Domain\User\V1\Controllers\FetchUserDetailsController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')
    ->middleware(['auth:jwt'])
    ->group(function () {

        Route::get('/', FetchUserDetailsController::class)
            ->name('user.fetch-details');

        Route::delete('/', DeleteAccountController::class)
            ->name('user.delete');

        Route::put('edit', EditUserController::class)
            ->name('user.edit');
    });
