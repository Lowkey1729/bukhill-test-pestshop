<?php

namespace Domain\Product\V1\DTOs;

use Spatie\LaravelData\Data;

class UpdateProductData extends Data
{
    public function __construct(
        public ?string $category_uuid,
        public ?string $title,
        public ?float $price,
        public ?string $description,
        public ?string $brand,
        public ?string $image,
    ) {}
}
