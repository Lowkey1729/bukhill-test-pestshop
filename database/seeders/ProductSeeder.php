<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new ProductFactory(10))->create();
    }
}
