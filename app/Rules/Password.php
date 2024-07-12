<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Password implements ValidationRule
{
    public function __construct(protected bool $empty = false, ...$args)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $empty = !$this->empty || !empty($value);
        if ($empty && !preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,16}$/', $value)) {
            $fail("The {$attribute} must contain minimum 8 and maximum 16 characters, at least 1 letter and 1 number.");
        }
    }
}
