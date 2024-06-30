<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *    title="Petshop API documentation",
 *    version="1.0.0",
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerToken",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
abstract class Controller
{
    //
}
