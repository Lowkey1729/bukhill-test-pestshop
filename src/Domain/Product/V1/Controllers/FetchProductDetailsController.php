<?php

namespace Domain\Product\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Product\V1\Actions\FetchProductDetailsAction;
use Domain\Product\V1\Exceptions\FetchProductDetailsException;
use Illuminate\Contracts\Support\Responsable;
use Support\Responses\V1\SuccessResponse;

class FetchProductDetailsController extends Controller
{
    /**
     * @OA\Get(
     *         path="/api/v1/product/{uuid}",
     *         operationId="ProductFetchDetails",
     *         tags={"Product"},
     *
     *         @OA\Parameter (
     *             in="path",
     *             name="uuid",
     *             required=true
     *         ),
     *
     *         @OA\Response(
     *             response="200",
     *             description="fetched product successfully",
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
     * @throws FetchProductDetailsException
     */
    public function __invoke(string $uuid): Responsable
    {
        $product = FetchProductDetailsAction::execute($uuid);

        return new SuccessResponse(
            data: $product
        );
    }
}
