<?php

namespace Domain\User\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Domain\User\V1\Actions\ViewOrderAction;
use Domain\User\V1\DTOs\ViewOrderData;
use Domain\User\V1\Exceptions\ViewOrderException;
use Domain\User\V1\Requests\ViewOrderRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class ViewOrdersController extends Controller
{
    /**
     * @OA\Get(
     *         path="/api/v1/user/orders",
     *         operationId="UserOrders",
     *         tags={"User"},
     *         security={{"bearerAuth":{}}},
     *
     *      @OA\Parameter (
     *             in="query",
     *             name="limit",
     *             required=false
     *         ),
     *      @OA\Parameter (
     *             in="query",
     *             name="page",
     *             required=false
     *         ),
     *      @OA\Parameter (
     *             in="query",
     *             name="desc",
     *             required=false,
     *
     *             @OA\Schema(
     *                type="boolean",
     *                ),
     *         ),
     *
     *      @OA\Parameter (
     *             in="query",
     *             name="sort_by",
     *             required=false
     *         ),
     *
     *         @OA\Response(
     *             response="200",
     *             description="View orders",
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
     * @throws InvalidDataClass
     * @throws ViewOrderException
     */
    public function __invoke(ViewOrderRequest $request): Responsable
    {
        /** @var ViewOrderData $data */
        $data = $request->getData();

        /** @var User $user */
        $user = $request->user();

        $result = ViewOrderAction::execute($data, $user);

        return new SuccessResponse(
            data: $result
        );
    }
}
