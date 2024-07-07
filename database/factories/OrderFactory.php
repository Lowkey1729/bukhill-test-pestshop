<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shipped_at' => now(),
            'payment_id' => Payment::query()
                ->pluck('id')[fake()
                ->numberBetween(1, Payment::query()->count() - 1)],

            'products' => $this->getProducts(),
            'address' => [
                'billing' => fake()->streetAddress,
                'shipping' => fake()->address,
            ],
            'delivery_fee' => fake()->numberBetween(1, 9),
            'amount' => fake()->numberBetween(100, 890),

            'order_status_id' => OrderStatus::query()
                ->pluck('id')[fake()
                ->numberBetween(1, OrderStatus::query()->count() - 1)],

            'user_id' => User::query()->pluck('id')[fake()
                ->numberBetween(1, User::query()->count() - 1)],

        ];
    }

    protected function getProducts(): array
    {
        return Product::query()
            ->select('uuid')
            ->get()
            ->collect()
            ->each(function ($product) {
                $product->forceFill([
                    'quantity' => fake()->numberBetween(1, 7)]);
            })->toArray();
    }
}
