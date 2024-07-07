<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Services\JWT\JWT;
use Support\Enums\UserType;

test('it only allows admin users to delete user details', function () {

    $user = (new UserFactory())
        ->state(fn (array $attributes) => [
            'is_admin' => UserType::USER->value,
        ])
        ->create();

    JWT::actingAs($user);

    $response = $this->deleteJson(
        uri: route('admin.user-delete', ['uuid' => $user->uuid]),
    );

    $response->assertStatus(403);

    expect($response->json())
        ->success->toBeFalse()
        ->error->toBe('You do not have the permission to access this resource');
});

test('it deletes user from the system', function () {

    /** @var User $user */
    $user = (new UserFactory())
        ->state(fn (array $attributes) => [
            'is_admin' => UserType::ADMIN->value,
        ])
        ->create();

    JWT::actingAs($user);

    $response = $this->deleteJson(
        uri: route('admin.user-delete', ['uuid' => $user->uuid]),
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue();
});
