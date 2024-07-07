<?php

namespace Domain\Auth\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Auth\V1\Actions\LogoutAction;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Support\Responses\V1\SuccessResponse;

class LogoutController extends Controller
{
    /**
     * @OA\Get(
     *          path="/api/v1/user/logout",
     *          operationId="LogoutUser",
     *          tags={"User"},
     *          security={{"bearerAuth":{}}},
     *
     *          @OA\Response(
     *              response="200",
     *              description="User logout successful",
     *
     *              @OA\JsonContent()
     *          ),
     *      )
     */
    public function __invoke(Request $request): Responsable
    {
        LogoutAction::execute($request->user('jwt'));

        return new SuccessResponse;
    }
}
