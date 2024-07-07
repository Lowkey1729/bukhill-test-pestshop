<?php

namespace Domain\Product\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Product\V1\Actions\CreateProductAction;
use Domain\Product\V1\DTOs\CreateProductData;
use Domain\Product\V1\Requests\CreateProductRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class CreateProductController extends Controller
{
    /**
     * @OA\Post(
     *       path="/api/v1/product/create",
     *       operationId="ProductCreate",
     *       tags={"Product"},
     *
     *       @OA\RequestBody(
     *
     *           @OA\JsonContent(),
     *
     *           @OA\MediaType(
     *               mediaType="multipart/form-data",
     *
     *               @OA\Schema(
     *                   type="object",
     *                   required={
     *                    "category_uuid",
     *                    "title",
     *                    "price",
     *                    "description",
     *                    "brand",
     *                    "image",
     *                    "metadata",
     *                    },
     *
     *                   @OA\Property(property="category_uuid",type="string"),
     *                   @OA\Property(property="title",type="string"),
     *                   @OA\Property(property="price",type="number"),
     *                   @OA\Property(property="description",type="string"),
     *                   @OA\Property(property="brand",type="string"),
     *                   @OA\Property(property="image",type="string"),
     *               ),
     *           ),
     *       ),
     *
     *       @OA\Response(
     *           response="200",
     *           description="create product successful",
     *
     *           @OA\JsonContent()
     *       ),
     *
     *       @OA\Response(
     *          response="422",
     *          description="Unprocessable Entity",
     *
     *         @OA\JsonContent()
     *       ),
     *   )
     *
     * @throws InvalidDataClass
     */
    public function __invoke(CreateProductRequest $request): Responsable
    {
        /** @var CreateProductData $data */
        $data = $request->getData();

        $product = CreateProductAction::execute($data);

        return new SuccessResponse(
            data: $product
        );
    }
}
