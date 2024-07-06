<?php

use App\Models\JwtToken;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertCount;

uses(RefreshDatabase::class);

test('it generates a valid token', function () {
    /** @var User $user */
    $user = (new UserFactory())->create();

    $plainTextToken = $user->createToken('Test token')->getPlainTextToken();

    tokenIsCompliantToRFC7519($plainTextToken, $user->getKey());
});

test('it saves generated token', function () {
    /** @var User $user */
    $user = (new UserFactory())->create();

    $token = $user->createToken('Test token')->getAccessToken();

    /** @var JwtToken $latestToken */
    $latestToken = $user->tokens()->latest()->first();

    expect($token->tokenable->toArray())
        ->toBe($latestToken->tokenable->toArray());
});

function tokenIsCompliantToRFC7519(string $token, string $modelKey): void
{
    $parts = explode('.', $token);

    $payload = base64_decode($parts[1]);
    $payload = json_decode($payload, true);

    assertCount(3, $parts);
    expect($parts)
        ->toHaveCount(3)
        ->and($payload)
        ->toBeArray()
        ->toHaveKey('iss')
        ->toHaveKey('jti')
        ->toHaveKey('aud')
        ->toHaveKey('iat')
        ->toHaveKey('nbf')
        ->toHaveKey('exp')
        ->and($payload['jti'])
        ->toBe($modelKey);
}
