<?php

namespace Domain\Product\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Product\V1\Actions\FetchProductsAction;
use Domain\Product\V1\DTOs\FetchProductsData;
use Domain\Product\V1\Requests\FetchProductsRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class FetchProductsController extends Controller
{
    /**
     * @OA\Get(
     *         path="/api/v1/products",
     *         operationId="ProductsAll",
     *         tags={"Product"},
     *
     *      @OA\Parameter (
     *             in="query",
     *             name="price",
     *             required=false,
     *
     *               @OA\Schema(
     *                 type="integer",
     *                 ),
     *         ),
     *
     *      @OA\Parameter (
     *             in="query",
     *             name="category",
     *             required=false
     *         ),
     *      @OA\Parameter (
     *             in="query",
     *             name="title",
     *             required=false
     *         ),
     *      @OA\Parameter (
     *             in="query",
     *             name="brand",
     *             required=false
     *         ),
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
     *             description="string",
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
     */
    public function __invoke(FetchProductsRequest $request): Responsable
    {
        /** @var FetchProductsData $data */
        $data = $request->getData();

        $result = FetchProductsAction::execute($data);

        return new SuccessResponse(
            data: [
                'products' => $result,
            ]
        );
    }
}
