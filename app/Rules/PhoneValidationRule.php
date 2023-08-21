<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class PhoneValidationRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if (! preg_match('/^(?:\+\d{1,3}[-\/\s]?)?(?:\d{1,3}[-\/\s]?)?\d{1,3}[-\/\s]?\d{3,4}[-\/\s]?\d{3,4}$/', $value)) {
            $fail('Невалиден формат за телефонски број');
        }
    }
}
