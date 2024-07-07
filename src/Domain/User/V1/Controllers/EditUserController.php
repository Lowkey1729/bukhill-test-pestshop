<?php

namespace Domain\User\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\User\V1\Requests\EditUserRequest;
use Illuminate\Contracts\Support\Responsable;
use Support\Responses\V1\SuccessResponse;

class EditUserController extends Controller
{
    public function __invoke(EditUserRequest $request): Responsable
    {
        return new SuccessResponse(
            data: $request->user()
        );
    }
}
