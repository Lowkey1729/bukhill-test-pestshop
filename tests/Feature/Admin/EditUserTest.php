<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Services\JWT\JWT;

test('it only allows authenticated users to edit user details', function () {
    $response = $this->putJson(
        uri: route('admin.user-edit', ['uuid' => fake()->uuid]),
    );

    $response->assertStatus(401);
});

test('it only allows admin users to edit user details', function () {
    $response = $this->putJson(
        uri: route('admin.user-edit', ['uuid' => fake()->uuid]),
    );

    $response->assertStatus(401);
});

test('it updates some details of a user on the system', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    JWT::actingAs($user);

    $response = $this->putJson(
        uri: route('admin.user-edit', ['uuid' => $user->uuid]),
        data: [
            'email' => $email = fake()->email,
        ]
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->and($data['data'])
        ->email->toBe($email);
});
