<?php

namespace KoenSchipper\AddressParser\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use KoenSchipper\AddressParser\LaravelAddressParser;

class DutchAddress implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('The :attribute must be a string.');
            return;
        }

        $address = LaravelAddressParser::parse($value);

        if (empty($address->street) || empty($address->houseNumber)) {
            $fail('The :attribute is not a valid Dutch address.');
        }
    }
}
