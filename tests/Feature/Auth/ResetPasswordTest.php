<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Actions\ForgotPasswordAction;

test('it validates reset password request', function () {
    $response = $this->postJson(route('user.reset-password'));

    $response->assertStatus(422);
});

test('it throws an exception when an invalid token is used', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    $response = $this->postJson(
        uri: route('user.reset-password'),
        data: [
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => 'just a token',
        ]
    );

    $response->assertStatus(401);

    $data = $response->json();

    expect($data)
        ->success->toBeFalse()
        ->error->toBe('Invalid password reset request');
});

test('it successfully resets user password', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    $resetToken = ForgotPasswordAction::execute($user->email);

    $response = $this->postJson(
        uri: route('user.reset-password'),
        data: [
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $resetToken,
        ]
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue();
});
