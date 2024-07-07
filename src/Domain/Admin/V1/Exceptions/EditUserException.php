<?php

namespace Domain\Admin\V1\Exceptions;

use Exception;
use Support\Concerns\ExceptionTrait;

class EditUserException extends Exception
{
    use ExceptionTrait;
}
