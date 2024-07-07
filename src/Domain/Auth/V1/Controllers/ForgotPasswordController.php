<?php

namespace Domain\Auth\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Auth\V1\Actions\ForgotPasswordAction;
use Domain\Auth\V1\Exceptions\ForgotPasswordException;
use Domain\Auth\V1\Requests\ForgotPasswordRequest;
use Illuminate\Contracts\Support\Responsable;
use Support\Responses\V1\SuccessResponse;

class ForgotPasswordController extends Controller
{
    /**
     * @OA\Post(
     *       path="/api/v1/user/forgot-password",
     *       operationId="UserForgotPassword",
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
     *                    "email",
     *                    },
     *
     *                   @OA\Property(property="email",type="string"),
     *               ),
     *           ),
     *       ),
     *
     *       @OA\Response(
     *           response="200",
     *           description="Generate forgot password token successful",
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
     *
     * @throws ForgotPasswordException
     */
    public function __invoke(ForgotPasswordRequest $request): Responsable
    {
        $resetToken = ForgotPasswordAction::execute($request->email);

        return new SuccessResponse(
            data: [
                'reset_token' => $resetToken,
            ]
        );
    }
}
