<?php

use App\Http\Middleware\OnlyAdminAccess;
use Domain\Admin\V1\Controllers\EditUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(['auth:jwt', OnlyAdminAccess::class])
    ->group(function () {

        Route::post('user-edit/{uuid}', EditUserController::class)
            ->name('admin.user-edit');

    });
