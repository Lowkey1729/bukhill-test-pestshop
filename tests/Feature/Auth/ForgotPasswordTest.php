<?php

use App\Models\User;
use Database\Factories\UserFactory;

test('it validates forgot password request', function () {
    $response = $this->postJson(route('user.forgot-password'));

    $response->assertStatus(422);
});

test('it returns reset token for reset password', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    $response = $this->postJson(
        uri: route('user.forgot-password'),
        data: [
            'email' => $user->email,
        ]
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->and($data['data'])
        ->reset_token->toBeString();
});
