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
     * @OA\Delete(
     *         path="/api/v1/user/delete",
     *         operationId="DeletetUser",
     *         tags={"User"},
     *         security={{"bearerAuth":{}}},
     *
     *         @OA\Response(
     *             response="200",
     *             description="User deleted successfully",
     *
     *             @OA\JsonContent()
     *         ),
     *
     *         @OA\Response(
     *            response="422",
     *            description="Unprocessable Entity",
     *
     *           @OA\JsonContent()
     *         ),
     *     )
     *
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
