<?php

namespace Domain\Auth\Services\JWT;

use App\Models\JwtToken;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User;
use Mockery;

class JWT
{
    /**
     * Set the current user for the application with the given abilities.
     *
     * @param  array<int, string>  $abilities
     */
    public static function actingAs(Authenticatable $user, array $abilities = ['*'], string $guard = 'jwt'): Authenticatable
    {
        $mockInterface = Mockery::mock(JwtToken::class)->shouldIgnoreMissing(false);

        /** @var Mockery\Expectation $token */
        $token = $mockInterface->shouldReceive('can');

        if (in_array('*', $abilities)) {
            $token->withAnyArgs()->andReturn(true);
        } else {
            foreach ($abilities as $ability) {
                $token->with($ability)->andReturn(true);
            }
        }

        /**
         * @var JwtToken $token
         */
        $user->withAccessToken($token);

        if (isset($user->wasRecentlyCreated) && $user->wasRecentlyCreated) {
            $user->wasRecentlyCreated = false;
        }

        app('auth')->guard($guard)->setUser($user);

        app('auth')->shouldUse($guard);

        return $user;
    }
}
