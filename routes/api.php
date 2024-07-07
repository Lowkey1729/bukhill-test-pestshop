<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
    require __DIR__.'/../src/Domain/Auth/V1/routes/api.php';
    require __DIR__.'/../src/Domain/Admin/V1/routes/api.php';
    require __DIR__.'/../src/Domain/User/V1/routes/api.php';
});
