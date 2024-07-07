<?php

namespace Domain\Product\V1\Exceptions;

use Exception;
use Support\Concerns\ExceptionTrait;

class DeleteProductException extends Exception
{
    use ExceptionTrait;
}
