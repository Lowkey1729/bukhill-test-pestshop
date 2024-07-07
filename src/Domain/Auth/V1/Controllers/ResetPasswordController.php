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
