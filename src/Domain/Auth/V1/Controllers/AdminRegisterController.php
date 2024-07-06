<?php

namespace Domain\Auth\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Auth\V1\Actions\RegisterAction;
use Domain\Auth\V1\DTOs\RegisterData;
use Domain\Auth\V1\Requests\RegisterRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class AdminRegisterController extends Controller
{
    /**
     * @throws InvalidDataClass
     * @throws \Exception
     */
    public function __invoke(RegisterRequest $request): Responsable
    {
        /** @var RegisterData $data */
        $data = $request->getData();

        $user = RegisterAction::execute(registerData: $data, isAdmin: true);

        return new SuccessResponse(
            data: $user->toArray(),
        );
    }
}
