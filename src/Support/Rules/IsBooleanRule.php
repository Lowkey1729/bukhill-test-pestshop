<?php

namespace Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsBooleanRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            ! in_array($value, [0, 1, 'true', 'false', true, false, '0', '1'], true)
        ) {
            $fail('The :attribute must be true or false.');
        }
    }
}
