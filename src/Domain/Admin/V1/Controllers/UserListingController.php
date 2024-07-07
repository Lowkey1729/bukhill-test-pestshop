<?php

namespace Domain\Admin\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Admin\V1\Actions\UserListingAction;
use Domain\Admin\V1\DTOs\UserListingData;
use Domain\Admin\V1\Requests\UserListingRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class UserListingController extends Controller
{
    /**
     * @OA\Get(
     *        path="/api/v1/admin/user-listing/",
     *        operationId="AdminUserListing",
     *        tags={"Admin"},
     *        security={{"bearerAuth":{}}},
     *
     *        @OA\Parameter (
     *           in="query",
     *           name="email",
     *           required=false
     *       ),
     *     @OA\Parameter (
     *            in="query",
     *            name="first_name",
     *            required=false
     *        ),
     *     @OA\Parameter (
     *            in="query",
     *            name="last_name",
     *            required=false
     *        ),
     *     @OA\Parameter (
     *            in="query",
     *            name="phone_number",
     *            required=false
     *        ),
     *     @OA\Parameter (
     *            in="query",
     *            name="address",
     *            required=false
     *        ),
     *     @OA\Parameter (
     *            in="query",
     *            name="limit",
     *            required=false
     *        ),
     *     @OA\Parameter (
     *            in="query",
     *            name="page",
     *            required=false
     *        ),
     *     @OA\Parameter (
     *            in="query",
     *            name="desc",
     *            required=false,
     *
     *            @OA\Schema(
     *               type="boolean",
     *               ),
     *        ),
     *
     *     @OA\Parameter (
     *            in="query",
     *            name="sort_by",
     *            required=false
     *        ),
     *     @OA\Parameter (
     *            in="query",
     *            name="is_marketing",
     *            required=false,
     *
     *            @OA\Schema(
     *              type="boolean",
     *              ),
     *        ),
     *
     *     @OA\Parameter (
     *            in="query",
     *            name="created_at",
     *            required=false
     *        ),
     *
     *        @OA\Response(
     *            response="200",
     *            description="Admin uder data edited successfully",
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
     * @throws InvalidDataClass
     */
    public function __invoke(UserListingRequest $request): Responsable
    {
        /** @var UserListingData $data */
        $data = $request->getData();

        $result = UserListingAction::execute($data);

        return new SuccessResponse(
            data: $result
        );
    }
}
