<?php

use App\Models\JwtToken;
use App\Models\User;
use Database\Factories\UserFactory;
use Domain\Auth\Services\JWT\WebTokenService;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertCount;

uses(RefreshDatabase::class);

test('it generates a valid token', function () {
    $user = User::query()->first();
    $jwtService = new WebTokenService($user);
    $token = $jwtService->issueToken();
    tokenIsAValidOne($token, $user?->uuid);
});

test('it saves generated token', function () {
    /** @var User $user */
    $user = (new UserFactory())->create();

    $token = $user->createToken('Test token')->getAccessToken();

    /** @var JwtToken $latestToken */
    $latestToken = $user->tokens()->latest()->first();

    expect($token->tokenable)
        ->toBe($latestToken->tokenable);
});

function tokenIsAValidOne(string $token, string $userUUid): void
{
    $parts = explode('.', $token);

    $payload = base64_decode($parts[1]);
    $payload = json_decode($payload, true);

    assertCount(3, $parts);
    expect($parts)
        ->toHaveCount(3)
        ->and($payload)
        ->toBeJson()
        ->toHaveKey('iss')
        ->toHaveKey('jti')
        ->toHaveKey('aud')
        ->toHaveKey('iat')
        ->toHaveKey('nbf')
        ->toHaveKey('exp')
        ->and($payload['jti'])
        ->toBe($userUUid);
}
