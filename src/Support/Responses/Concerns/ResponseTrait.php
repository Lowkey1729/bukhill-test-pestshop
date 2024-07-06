<?php

namespace Support\Responses\Concerns;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function toResponse($request): JsonResponse
    {
        return response()
            ->json(
                $this->getResponseBlock(),
                $this->getStatusCode()
            );
    }
}
