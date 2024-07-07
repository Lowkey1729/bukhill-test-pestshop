<?php

namespace Domain\Auth\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Auth\V1\Actions\ResetPasswordAction;
use Domain\Auth\V1\DTOs\ResetPasswordData;
use Domain\Auth\V1\Exceptions\ResetPasswordException;
use Domain\Auth\V1\Requests\ResetPasswordRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class ResetPasswordController extends Controller
{
    /**
     * @OA\Post(
     *       path="/api/v1/user/reset-password",
     *       operationId="UserResetPassword",
     *       tags={"User"},
     *
     *       @OA\RequestBody(
     *
     *           @OA\JsonContent(),
     *
     *           @OA\MediaType(
     *               mediaType="multipart/form-data",
     *
     *               @OA\Schema(
     *                   type="object",
     *                   required={
     *                    "token",
     *                    "email",
     *                    "password",
     *                    "password_confirmation",
     *                    },
     *
     *                   @OA\Property(property="token",type="string"),
     *                   @OA\Property(property="email",type="string"),
     *                   @OA\Property(property="password",type="string"),
     *                   @OA\Property(property="password_confirmation",type="string"),
     *               ),
     *           ),
     *       ),
     *
     *       @OA\Response(
     *           response="200",
     *           description="User reset password successful",
     *
     *           @OA\JsonContent()
     *       ),
     *
     *       @OA\Response(
     *          response="422",
     *          description="Unprocessable Entity",
     *
     *         @OA\JsonContent()
     *       ),
     *   )
     * @throws InvalidDataClass
     * @throws ResetPasswordException
     */
    public function __invoke(ResetPasswordRequest $request): Responsable
    {
        /** @var ResetPasswordData $data */
        $data = $request->getData();

        ResetPasswordAction::execute($data);

        return new SuccessResponse;
    }
}
