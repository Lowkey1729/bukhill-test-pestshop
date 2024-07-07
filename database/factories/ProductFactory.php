<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_uuid' => Category::query()
                ->pluck('uuid')[fake()
                ->numberBetween(1, Category::query()->count() - 1)],
            'title' => fake()->word,
            'metadata' => [],
            'price' => fake()->numberBetween(900.12, 123.89),
            'description' => fake()->text,
        ];
    }
}
