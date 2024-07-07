<?php

namespace Domain\Product\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Product\V1\Actions\UpdateProductAction;
use Domain\Product\V1\DTOs\UpdateProductData;
use Domain\Product\V1\Exceptions\UpdateProductException;
use Domain\Product\V1\Requests\UpdateProductRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class UpdateProductController extends Controller
{
    /**
     * @OA\Put(
     *        path="/api/v1/product/{uuid}",
     *        operationId="ProductEdit",
     *        tags={"Product"},
     *
     *        @OA\Parameter (
     *            in="path",
     *            name="uuid",
     *            required=true
     *        ),
     *
     *        @OA\RequestBody(
     *
     *            @OA\JsonContent(),
     *
     *            @OA\MediaType(
     *                mediaType="multipart/form-data",
     *
     *                @OA\Schema(
     *                    type="object",
     *
     *                    @OA\Property(property="category_uuid",type="string"),
     *                    @OA\Property(property="title",type="string"),
     *                    @OA\Property(property="price",type="number"),
     *                    @OA\Property(property="description",type="string"),
     *                    @OA\Property(property="brand",type="string"),
     *                    @OA\Property(property="image",type="string"),
     *                    @OA\Property(property="metadata",type="object"),
     *                ),
     *            ),
     *        ),
     *
     *        @OA\Response(
     *            response="200",
     *            description="update product successful",
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
     * @throws UpdateProductException
     */
    public function __invoke(UpdateProductRequest $request, string $uuid): Responsable
    {
        /** @var UpdateProductData $data */
        $data = $request->getData();

        $product = UpdateProductAction::execute($data, $uuid);

        return new SuccessResponse(
            data: $product
        );
    }
}
