<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Support\Enums\PaymentType;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentType = $this->getPaymentType();

        return [
            'type' => $paymentType,
            'details' => $this->getPaymentDetails($paymentType),
        ];
    }

    protected function getPaymentType(): string|int
    {
        $paymentTypes = PaymentType::cases();

        return $paymentTypes[rand(0, 2)]->value;
    }

    protected function getPaymentDetails(string|int $paymentType): array
    {
        return match ($paymentType) {
            PaymentType::CASH_ON_DELIVERY->value => [
                'holder_name' => fake()->name,
                'number' => fake()->creditCardNumber,
                'ccv' => fake()->randomNumber(3),
                'expire_date' => fake()->creditCardExpirationDate,
            ],

            PaymentType::BANK_TRANSFER->value => [
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'address' => fake()->address,
            ],

            PaymentType::CREDIT_CARD->value => [
                'swift' => fake()->swiftBicNumber,
                'iban' => fake()->iban,
                'name' => fake()->name,
            ],

            default => []
        };
    }
}
