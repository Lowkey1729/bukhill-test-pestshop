<?php

namespace Database\Seeders;

use Database\Factories\PaymentFactory;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new PaymentFactory(10))->create();
    }
}
