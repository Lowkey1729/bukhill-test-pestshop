<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Services\JWT\JWT;
use Support\Enums\UserType;

test('it allows only authenticated user to delete account', function () {
    $response = $this->getJson(
        uri: route('user.delete'),
    );

    $response->assertStatus(401);
});

test('it deletes user from the system', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    JWT::actingAs($user);

    $response = $this->deleteJson(
        uri: route('user.delete'),
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue();
});
