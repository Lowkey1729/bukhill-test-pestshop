<?php

namespace Domain\Auth\V1\Services\JWT;

use DateTimeImmutable;
use Exception;
use Illuminate\Foundation\Auth\User;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Constraint\IdentifiedBy;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\StrictValidAt;
use Lcobucci\JWT\Validation\Validator;
use Psr\Clock\ClockInterface;
use Psr\Clock\ClockInterface as Clock;
use RuntimeException;

final class WebTokenService
{
    protected Builder $tokenBuilder;

    protected Sha256 $signer;

    protected InMemory $signingKey;

    protected Parser $parser;

    protected DateTimeImmutable $expiresAt;

    protected DateTimeImmutable $now;

    protected ClockInterface $clock;

    protected string $appUrl;

    /**
     * @var non-empty-string
     */
    protected string $identifiedBy;

    /**
     * @throws Exception
     */
    public function __construct(protected User $user)
    {
        $this->parser = new Parser(new JoseEncoder());
        $this->tokenBuilder = (new Builder(
            new JoseEncoder(),
            ChainedFormatter::default()
        ));
        $this->signer = new Sha256();
        $this->signingKey = InMemory::plainText(random_bytes(32));
        $this->now = new DateTimeImmutable();

        $expiresAt = $this->now->modify(config('jwt.expiration'));
        if (! $expiresAt) {
            throw new RuntimeException('Invalid  JWT expiration date');
        }

        $this->expiresAt = $expiresAt;
        $this->appUrl = config('app.url');
        $this->clock = new class() implements Clock
        {
            public function now(): DateTimeImmutable
            {
                return new DateTimeImmutable();
            }
        };

        /** @var non-empty-string $identifiedBy */
        $identifiedBy = $this->user->getAuthIdentifier();
        $this->identifiedBy = $identifiedBy;

    }

    /**
     * Token is issued based on the request host,
     * the user uuid and the time it should it expire
     */
    public function issueToken(): string
    {
        $token = $this->tokenBuilder
            ->issuedBy(config('app.url'))
            ->permittedFor(config('app.url'))
            ->identifiedBy($this->identifiedBy)
            ->issuedAt($this->now)
            ->canOnlyBeUsedAfter($this->now->modify(config('jwt.used_after')))
            ->expiresAt($this->getExpiresAt())
            ->withHeader('alg', $this->signer->algorithmId())
            ->getToken($this->signer, $this->signingKey);

        return $token->toString();
    }

    /**
     * This validates the token based on if the request host that issued it,
     * the user id and the time it expires matches that of the token
     *
     * @param  non-empty-string  $token
     */
    public function validateToken(string $token): bool
    {
        $parsedToken = $this->parser->parse($token);

        return (new Validator())->validate(
            $parsedToken,
            new IdentifiedBy($this->identifiedBy),
            new IssuedBy(config('app.url')),
            (new StrictValidAt($this->clock))
        );
    }

    public function getExpiresAt(): DateTimeImmutable
    {
        return $this->expiresAt;
    }
}
