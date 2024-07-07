<?php

use App\Models\Category;
use App\Models\User;
use Database\Factories\CategoryFactory;
use Database\Factories\UserFactory;
use Domain\Auth\V1\Services\JWT\JWT;

test('it allows authenticated users to create product', function () {
    $response = $this->postJson(route('product.create'));

    $response->assertStatus(401);

});

test('it validates create product request', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    JWT::actingAs($user);

    $response = $this->postJson(route('product.create'));

    $response->assertStatus(422);
});

test('it creates a product successfully', function () {

    /** @var User $user */
    $user = (new UserFactory())->create();

    /** @var Category $category */
    $category = (new CategoryFactory())->create();

    JWT::actingAs($user);

    $response = $this->postJson(
        uri: route('product.create'),
        data: $payload = [
            'category_uuid' => $category->uuid,
            'title' => fake()->text,
            'price' => fake()->numberBetween(900.12, 123.89),
            'description' => fake()->text,
            'brand' => fake()->text,
            'image' => fake()->uuid,
        ]
    );

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->and($data['data'])
        ->category_uuid->toBe($category->uuid)
        ->price->toBe($payload['price'])
        ->description->toBe($payload['description']);
});
