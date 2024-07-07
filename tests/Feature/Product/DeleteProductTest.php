<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Services\JWT\JWT;
use Domain\Product\V1\Exceptions\DeleteProductException;

test('it allows authenticated users to delete product', function () {
    $response = $this->putJson(route('product.delete', ['uuid' => fake()->uuid]));

    $response->assertStatus(401);
});

test('it throws an exception for an invalid product id', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    JWT::actingAs($user);

    $response = $this->deleteJson(route('product.delete', ['uuid' => 'fake uuid']));

    $response->assertStatus(404);

    expect($response)
        ->exception
        ->toBeInstanceOf(DeleteProductException::class);
});
