<?php

namespace Domain\Product\V1\Actions;

use App\Models\Product;
use Domain\Product\V1\DTOs\CreateProductData;

class CreateProductAction
{
    /**
     * @return array<string, mixed>
     */
    public static function execute(CreateProductData $data): array
    {
        $product = Product::query()->firstOrCreate(
            $data->except('brand', 'image')->toArray()
        );

        return $product->toArray();
    }
}
