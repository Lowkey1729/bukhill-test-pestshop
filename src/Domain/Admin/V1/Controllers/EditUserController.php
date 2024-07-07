<?php

namespace Domain\Admin\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Admin\V1\Actions\EditUserAction;
use Domain\Admin\V1\DTOs\EditUserData;
use Domain\Admin\V1\Exceptions\EditUserException;
use Domain\Admin\V1\Requests\EditUserRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class EditUserController extends Controller
{
    /**
     * @throws InvalidDataClass|EditUserException
     */
    public function __invoke(EditUserRequest $request, string $uuid): Responsable
    {
        /** @var EditUserData $data */
        $data = $request->getData();

        $user = EditUserAction::execute($data, $uuid);

        return new SuccessResponse(
            data: $user->toArray()
        );
    }
}
