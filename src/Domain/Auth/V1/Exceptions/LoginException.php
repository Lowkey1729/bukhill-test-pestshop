<?php

namespace Domain\Auth\V1\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Support\Responses\V1\FailedResponse;

class LoginException extends Exception
{
    public function render(): Responsable
    {
        return new FailedResponse(
            errorMessage: $this->getMessage(),
            statusCode: $this->getCode()
        );
    }
}
