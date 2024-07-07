<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        (new UserFactory(10))->create();

        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OrderStatusSeeder::class,
            PaymentSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
