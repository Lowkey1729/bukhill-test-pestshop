<?php

namespace Domain\User\V1\Exceptions;

use Exception;
use Support\Concerns\ExceptionTrait;

class ViewOrderException extends Exception
{
    use ExceptionTrait;
}
