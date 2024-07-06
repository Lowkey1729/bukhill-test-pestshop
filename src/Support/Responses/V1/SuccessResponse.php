<?php

namespace Support\Responses\V1;

use Illuminate\Contracts\Support\Responsable;
use Support\Responses\Concerns\ResponseTrait;
use Support\Responses\Contracts\ApiResponseInterface;

class SuccessResponse implements ApiResponseInterface, Responsable
{
    use ResponseTrait;

    public function __construct(
        public readonly array $data = [],
        public readonly array $topLevelData = [],
        public readonly int $statusCode = 200,
    ) {}

    public function getResponseBlock(): array
    {
        return [
            'success' => true,
            'data' => $this->data,
            'error' => null,
            'errors' => [],
            'extra' => $this->topLevelData,
        ];
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
