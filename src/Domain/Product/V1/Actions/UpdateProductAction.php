<?php

namespace Domain\Product\V1\Actions;

use App\Models\Product;
use Domain\Product\V1\DTOs\UpdateProductData;
use Domain\Product\V1\Exceptions\UpdateProductException;

class UpdateProductAction
{
    /**
     * @return array<string, mixed>
     *
     * @throws UpdateProductException
     */
    public static function execute(UpdateProductData $data, string $uuid): array
    {
        $product = Product::query()->where('uuid', $uuid)->first();

        if (! $product) {
            throw new UpdateProductException('Product not found', 404);
        }

        /** @var Product $product */
        $product->update(
            array_filter(
                array_merge($data->toArray(), self::metadata($product, $data)),
                fn ($item) => ! is_null($item)
            )
        );

        return $product->toArray();
    }

    /**
     * @return array<string, array<string, string>>
     */
    protected static function metadata(Product $product, UpdateProductData $data): array
    {
        return [
            'metadata' => [
                'brand' => $data->brand ?? ($product->metadata['brand'] ?? ''),
                'image' => $data->image ?? ($product->metadata['image'] ?? ''),
            ],
        ];
    }
}
