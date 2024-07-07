<?php

namespace Domain\Product\V1\Actions;

use App\Models\Product;
use Domain\Product\V1\Exceptions\DeleteProductException;

class DeleteProductAction
{
    /**
     * @throws DeleteProductException
     */
    public static function execute(string $uuid): void
    {
        $product = Product::query()->where('uuid', $uuid)->first();

        if (! $product) {
            throw new DeleteProductException('Product not found', 404);
        }

        $product->delete();
    }
}
