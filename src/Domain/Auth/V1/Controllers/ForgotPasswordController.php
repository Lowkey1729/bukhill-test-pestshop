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
