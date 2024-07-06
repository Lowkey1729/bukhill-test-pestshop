<?php

namespace Domain\Auth\Services\JWT;

use App\Models\JwtToken;
use Exception;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

final class Guard
{
    /**
     * Create a new guard instance.
     */
    public function __construct(
        protected AuthFactory $auth,
        protected ?string $expiration = null,
        protected ?string $provider = null
    ) {}

    /**
     * @throws Exception
     */
    public function __invoke(Request $request, ?User $user): ?Authenticatable
    {
        $token = $request->bearerToken();

        if (! $token) {
            return null;
        }

        $accessToken = JwtToken::findToken($token);

        if (! $accessToken) {
            return null;
        }

        /** @var JwtToken $accessToken */
        /** @var User $user */
        if (
            ! $this->isValidAccessToken($accessToken->tokenable, $token)
            && ! $this->hasValidProvider($accessToken->tokenable)
        ) {
            return null;
        }

        $accessToken->update(['last_used_at' => now()]);

        return $accessToken->tokenable;
    }

    /**
     * Determine if the provided access token is valid.
     *
     * @throws Exception
     */
    protected function isValidAccessToken(?Authenticatable $user, string $token): bool
    {
        if (! $token) {
            return false;
        }

        return (new WebTokenService($user))->validateToken($token);
    }

    /**
     * Determine if the tokenable model matches the provider's model type.
     */
    protected function hasValidProvider(Authenticatable $tokenable): bool
    {
        if (is_null($this->provider)) {
            return true;
        }

        $model = config("auth.providers.{$this->provider}.model");

        return $tokenable instanceof $model;
    }
}
