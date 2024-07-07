<?php

namespace Domain\User\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Domain\Admin\V1\Actions\DeleteUserAction;
use Domain\Admin\V1\Exceptions\DeleteUserException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Support\Responses\V1\SuccessResponse;

class DeleteAccountController extends Controller
{
    /**
     * @throws DeleteUserException
     */
    public function __invoke(Request $request): Responsable
    {
        /** @var User $user */
        $user = $request->user();

        DeleteUserAction::execute($user->uuid);

        return new SuccessResponse;
    }
}
