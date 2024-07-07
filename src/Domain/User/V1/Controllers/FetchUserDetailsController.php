<?php

namespace Domain\User\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Support\Responses\V1\SuccessResponse;

class FetchUserDetailsController extends Controller
{
    /**
     * @OA\Get(
     *         path="/api/v1/user",
     *         operationId="FetchUserDetails",
     *         tags={"User"},
     *         security={{"bearerAuth":{}}},
     *
     *         @OA\Response(
     *             response="200",
     *             description="User details fetched successfully",
     *
     *             @OA\JsonContent()
     *         ),
     *     )
     */
    public function __invoke(Request $request): Responsable
    {
        /** @var User $user */
        $user = $request->user();

        return new SuccessResponse(
            data: $user->toArray()
        );
    }
}
