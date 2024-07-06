<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Support\Enums\UserType;

beforeEach(function () {
    $this->password = 'userpassword';
});

test('it validates login request', function () {
    $response = $this->postJson(route('user.login'));

    $response->assertStatus(422);
});

test('it generates token for admin users', function () {

    /** @var User $user */
    $user = (new UserFactory())
        ->state(fn (array $attributes) => [
            'type' => UserType::ADMIN->value,
        ])->create();

    $response = $this->postJson(
        uri: route('user.login'),
        data: [
            'email' => $user->email,
            'password' => $this->password,
        ]
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->data->toBeArray()
        ->and($data['data'])
        ->toHaveKey('token');
});

test('it generates token for users that are not admin', function () {

    /** @var User $user */
    $user = (new UserFactory())
        ->state(fn (array $attributes) => [
            'type' => UserType::USER->value,
        ])->create();

    $response = $this->postJson(
        uri: route('user.login'),
        data: [
            'email' => $user->email,
            'password' => $this->password,
        ]
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->data->toBeArray()
        ->and($data['data'])
        ->toHaveKey('token');
});

test('it does not generate token for users with invalid credentials', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    $response = $this->postJson(
        uri: route('user.login'),
        data: [
            'email' => $user->email,
            'password' => 'just a password',
        ]
    );

    $response->assertStatus(401);

    $data = $response->json();

    expect($data)
        ->success->toBeFalse()
        ->error->toBe('The provided credentials are incorrect.');
});

test('it does not generate token for a user with an unverified email', function () {

    /** @var User $user */
    $user = (new UserFactory())->unverified()->create();

    $response = $this->postJson(
        uri: route('user.login'),
        data: [
            'email' => $user->email,
            'password' => $this->password,
        ]
    );

    $response->assertStatus(401);

    $data = $response->json();

    expect($data)
        ->success->toBeFalse()
        ->error->toBe('Email has not been verified.');
});
