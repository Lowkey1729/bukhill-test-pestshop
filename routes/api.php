<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
    require __DIR__.'/../src/Domain/Auth/V1/routes/api.php';
});
