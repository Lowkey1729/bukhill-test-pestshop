<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Support\Enums\UserType;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@buckhill.co.uk',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
            'avatar' => fake()->uuid,
            'is_marketing' => 0,
            'is_admin' => UserType::ADMIN->value,
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
        ]);
    }
}
