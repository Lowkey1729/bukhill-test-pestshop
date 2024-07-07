<?php

namespace Domain\Product\V1\Exceptions;

use Exception;
use Support\Concerns\ExceptionTrait;

class FetchProductDetailsException extends Exception
{
    use ExceptionTrait;
}
