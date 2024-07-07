<?php

namespace Database\Seeders;

use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new OrderFactory(10))->create();
    }
}
