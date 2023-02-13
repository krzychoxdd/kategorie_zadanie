<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValidateAvailableTranslations implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!in_array($value, config('app.language_available'))) {
            $fail('The :attribute must contain one of the available languages');
        }
    }
}
