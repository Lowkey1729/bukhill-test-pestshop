<?php

namespace Domain\Product\V1\DTOs;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class CreateProductData extends Data
{
    /**
     * @var array<string, string>
     */
    #[Computed]
    public array $metadata;

    public function __construct(
        public string $category_uuid,
        public string $title,
        public float $price,
        public string $description,
        public string $brand,
        public string $image,
    ) {
        $this->metadata = [
            'brand' => $this->brand,
            'image' => $this->image,
        ];
    }
}
