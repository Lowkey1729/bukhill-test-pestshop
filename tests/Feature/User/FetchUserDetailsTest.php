<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Services\JWT\JWT;
use Support\Enums\UserType;

test('it allows only authenticated user to fetch user details', function () {
    $response = $this->getJson(
        uri: route('user.fetch-details'),
    );

    $response->assertStatus(401);
});

test('it fetches user details successfully', function () {
    /** @var User $user */
    $user = (new UserFactory())
        ->state(fn (array $attributes) => [
            'is_admin' => UserType::USER->value,
        ])
        ->create();

    JWT::actingAs($user);

    $response = $this->getJson(
        uri: route('user.fetch-details'),
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->and($data['data'])
        ->first_name->toBe($user->first_name)
        ->last_name->toBe($user->last_name)
        ->email->toBe($user->email)
        ->is_admin->toBeFalse();
});
