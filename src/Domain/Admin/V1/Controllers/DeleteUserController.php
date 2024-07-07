<?php

namespace Domain\Admin\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Domain\Admin\V1\Exceptions\DeleteUserException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Support\Responses\V1\SuccessResponse;

class DeleteUserController extends Controller
{
    /**
     * @OA\Delete(
     *        path="/api/v1/admin/user-delete/{uuid}",
     *        operationId="AdminDeletetUser",
     *        tags={"Admin"},
     *        security={{"bearerAuth":{}}},
     *
     *           @OA\Parameter (
     *           in="path",
     *           name="uuid",
     *           required=true
     *       ),
     *
     *        @OA\Response(
     *            response="200",
     *            description="User deleted successfully",
     *
     *            @OA\JsonContent()
     *        ),
     *
     *        @OA\Response(
     *           response="422",
     *           description="Unprocessable Entity",
     *
     *          @OA\JsonContent()
     *        ),
     *    )
     *
     * @throws DeleteUserException
     */
    public function __invoke(string $uuid): Responsable
    {
        $user = User::whereUuid($uuid)->first();

        if (! $user) {
            throw new DeleteUserException('User not found', 404);
        }

        DB::transaction(function () use ($user) {
            $user->tokens()->delete();
            $user->delete();
        });

        return new SuccessResponse;
    }
}
