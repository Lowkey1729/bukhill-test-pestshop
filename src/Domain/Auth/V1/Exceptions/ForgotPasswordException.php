<?php

namespace Domain\Auth\V1\Exceptions;

use Exception;
use Support\Concerns\ExceptionTrait;

class ForgotPasswordException extends Exception
{
    use ExceptionTrait;
}
