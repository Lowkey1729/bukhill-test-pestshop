<?php

namespace Database\Seeders;

use Database\Factories\OrderStatusFactory;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new OrderStatusFactory(10))->create();
    }
}
