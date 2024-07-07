<?php

use App\Models\Product;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Domain\Product\V1\Exceptions\FetchProductDetailsException;

test('it throws an exception for an invalid product id', function () {


    $response = $this->getJson(route('product.details', ['uuid' => 'fake uuid']));

    $response->assertStatus(404);

    expect($response)
        ->exception
        ->toBeInstanceOf(FetchProductDetailsException::class);
});


test('it successfully fetches the details of a product', function () {

    (new CategoryFactory(2))->create();

    /** @var Product $product */
    $product = (new ProductFactory())->create();

    $response = $this->getJson(route('product.details', ['uuid' => $product->uuid]));

    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->and($data['data'])
        ->uuid->toBe($product->uuid)
        ->title->toBe($product->title);
});
