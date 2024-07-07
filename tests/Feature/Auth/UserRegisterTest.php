<?php

test('it validates register request', function () {
    $response = $this->postJson(route('user.register'));

    $response->assertStatus(422);
});

test('it registers user into the system', function () {
    $response = $this->postJson(
        uri: route('user.register'),
        data: $payload = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->email,
            'phone_number' => fake()->phoneNumber,
            'password' => 'password',
            'password_confirmation' => 'password',
            'address' => fake()->address,
            'is_marketing' => 1,
            'avatar' => fake()->uuid,
        ]

    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->and($data['data'])
        ->email->toBe($payload['email'])
        ->first_name->toBe($payload['first_name'])
        ->last_name->toBe($payload['last_name'])
        ->is_admin->toBeFalse()
        ->phone_number->toBe($payload['phone_number']);
});
