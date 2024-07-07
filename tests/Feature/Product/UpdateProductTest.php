<?php

use App\Models\Product;
use App\Models\User;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Services\JWT\JWT;
use Domain\Product\V1\Exceptions\UpdateProductException;

test('it allows authenticated users to update product', function () {
    $response = $this->putJson(route('product.update', ['uuid' => fake()->uuid]));

    $response->assertStatus(401);

});

test('it throws an exception for an invalid product id', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    JWT::actingAs($user);

    $response = $this->putJson(route('product.update', ['uuid' => 'fake uuid']));

    $response->assertStatus(404);

    expect($response)
        ->exception
        ->toBeInstanceOf(UpdateProductException::class);
});

test('it successfully updates product details', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    (new CategoryFactory(2))->create();

    /** @var Product $product */
    $product = (new ProductFactory())->create();

    JWT::actingAs($user);

    $response = $this->putJson(
        uri: route('product.update', ['uuid' => $product->uuid]),
        data: $payload = [
            'title' => fake()->title,
        ]
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->and($data['data'])
        ->title->toBe($payload['title'])
        ->category_uuid->toBe($product->category_uuid);
});
