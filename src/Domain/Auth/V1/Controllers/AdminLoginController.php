<?php

namespace Domain\Auth\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Auth\V1\Actions\LoginAction;
use Domain\Auth\V1\DTOs\LoginData;
use Domain\Auth\V1\Exceptions\LoginException;
use Domain\Auth\V1\Requests\LoginRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class AdminLoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/admin/login",
     *     operationId="Admin",
     *     tags={"Admin"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(),
     *
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *
     *             @OA\Schema(
     *                 type="object",
     *                 required={
     *                  "email",
     *                  "password",
     *                  },
     *
     *                 @OA\Property(property="email",type="string"),
     *                 @OA\Property(property="password",type="string"),
     *             ),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Admin login successful",
     *
     *         @OA\JsonContent()
     *     ),
     *
     *     @OA\Response(
     *        response="422",
     *        description="Unprocessable Entity",
     *
     *       @OA\JsonContent()
     *     ),
     * )
     *
     * @throws InvalidDataClass
     * @throws LoginException
     */
    public function __invoke(LoginRequest $request): Responsable
    {
        /** @var LoginData $data */
        $data = $request->getData();

        $token = LoginAction::execute(
            loginData: $data,
            isAdmin: true
        );

        return new SuccessResponse(
            data: [
                'token' => $token,
            ]
        );
    }
}
