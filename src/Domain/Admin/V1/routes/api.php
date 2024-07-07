<?php

use App\Http\Middleware\OnlyAdminAccess;
use Domain\Admin\V1\Controllers\DeleteUserController;
use Domain\Admin\V1\Controllers\EditUserController;
use Domain\Admin\V1\Controllers\UserListingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(['auth:jwt', OnlyAdminAccess::class])
    ->group(function () {

        Route::put('user-edit/{uuid}', EditUserController::class)
            ->name('admin.user-edit');

        Route::get('user-listing/', UserListingController::class)
            ->name('admin.user-listing');

        Route::delete('user-delete/{uuid}', DeleteUserController::class)
            ->name('admin.user-delete');

    });
