<?php

namespace Support\Responses\V1;

use Illuminate\Contracts\Support\Responsable;
use Support\Responses\Concerns\ResponseTrait;
use Support\Responses\Contracts\ApiResponseInterface;

class FailedResponse implements ApiResponseInterface, Responsable
{
    use ResponseTrait;

    public function __construct(
        protected string $errorMessage,
        protected array $data = [],
        protected array $errors = [],
        protected array $errorTrace = [],
        protected int $statusCode = 200
    ) {}

    public function getResponseBlock(): array
    {
        return [
            'success' => false,
            'data' => $this->data,
            'error' => $this->errorMessage,
            'errors' => $this->errors,
            'trace' => $this->errorTrace,
        ];
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
