<?php

namespace Domain\Admin\V1\Exceptions;

use Exception;
use Support\Concerns\ExceptionTrait;

class DeleteUserException extends Exception
{
    use ExceptionTrait;
}
