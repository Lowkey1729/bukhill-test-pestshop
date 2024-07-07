<?php

namespace Domain\Auth\V1\DTOs;

use Spatie\LaravelData\Data;

class ResetPasswordData extends Data
{
    public function __construct(
        public string $email,
        public string $token,
        #[\SensitiveParameter]
        public string $password,
    ) {}
}
