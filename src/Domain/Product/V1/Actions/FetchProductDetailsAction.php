<?php

namespace Domain\Product\V1\Actions;

use App\Models\Product;
use Domain\Product\V1\Exceptions\FetchProductDetailsException;

class FetchProductDetailsAction
{
    /**
     * @return array<string, mixed>
     *
     * @throws FetchProductDetailsException
     */
    public static function execute(string $uuid): array
    {
        $product = Product::query()->where('uuid', $uuid)->first();

        if (! $product) {
            throw new FetchProductDetailsException('Product not found', 404);
        }

        return $product->toArray();
    }
}
