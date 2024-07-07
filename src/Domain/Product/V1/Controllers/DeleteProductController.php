<?php

namespace Domain\Product\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Product\V1\Actions\DeleteProductAction;
use Domain\Product\V1\Exceptions\DeleteProductException;
use Illuminate\Contracts\Support\Responsable;
use Support\Responses\V1\SuccessResponse;

class DeleteProductController extends Controller
{
    /**
     * @OA\Delete(
     *         path="/api/v1/product/{uuid}",
     *         operationId="ProductDelete",
     *         tags={"Product"},
     *         security={{"bearerAuth":{}}},
     *
     *            @OA\Parameter (
     *            in="path",
     *            name="uuid",
     *            required=true
     *        ),
     *
     *         @OA\Response(
     *             response="200",
     *             description="product deleted successfully",
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
     * @throws DeleteProductException
     */
    public function __invoke(string $uuid): Responsable
    {
        DeleteProductAction::execute($uuid);

        return new SuccessResponse;
    }
}
