<?php

namespace Support\Concerns;

use Illuminate\Contracts\Support\Responsable;
use Support\Responses\V1\FailedResponse;

trait ExceptionTrait
{
    public function render(): Responsable
    {
        return new FailedResponse(
            errorMessage: $this->getMessage(),
            statusCode: $this->getCode() != 0 ? $this->getCode() : 400
        );
    }
}
