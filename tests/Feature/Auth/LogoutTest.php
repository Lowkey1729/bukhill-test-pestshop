<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Services\JWT\JWT;

test('it allows only authenticated user to logout', function () {
    $response = $this->getJson(
        uri: route('user.logout'),
    );

    $response->assertStatus(401);
});

test('it successfully logged out the user', function () {
    /** @var User $user */
    $user = (new UserFactory())->create();

    JWT::actingAs($user);

    $response = $this->getJson(
        uri: route('user.logout'),
    );

    $response->assertStatus(200);

    expect($response->json())
        ->success->toBeTrue();
});
