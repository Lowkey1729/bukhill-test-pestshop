<?php

namespace Domain\Auth\Services\JWT;

use App\Models\JwtToken;
use Exception;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasApiToken
{
    public string $plainTextToken;

    public JwtToken $accessToken;

    /**
     * @return MorphMany<JwtToken>
     */
    public function tokens(): MorphMany
    {
        return $this->morphMany(JwtToken::class, 'tokenable');
    }

    /**
     * @template T of HasApiToken
     *
     * @return T
     *
     * @throws Exception
     */
    public function createToken(string $tokenTitle, array $abilities = ['*']): self
    {
        $jwtService = new WebTokenService($this);

        $this->plainTextToken = $jwtService->issueToken();

        $token = $this->tokens()->create([
            'token' => hash('sha256', $this->getPlainTextToken()),
            'name' => $tokenTitle,
            'expires_at' => $jwtService->getExpiresAt(),
            'abilities' => $abilities,
        ]);

        $this->accessToken = $token;

        return $this;
    }

    public function currentAccessToken(): JwtToken
    {
        return $this->getAccessToken();
    }

    /**
     * @template T of HasApiToken
     *
     * @return T
     */
    public function withAccessToken(JwtToken $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getPlainTextToken(): string
    {
        return $this->plainTextToken;
    }

    public function getAccessToken(): JwtToken
    {
        return $this->accessToken;
    }

    public function deleteAccessToken(): void
    {
        $token = request()->bearerToken();

        if (! $token) {
            return;
        }

        JwtToken::query()
            ->where(
                'token',
                hash('sha256', $token)
            )->delete();
    }
}
