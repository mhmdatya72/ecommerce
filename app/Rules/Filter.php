<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected $forbiddenWords = ['spam', 'fake', 'illegal']; // قائمة الكلمات المحظورة

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->forbiddenWords as $word) {
            if (stripos($value, $word) !== false) {
                $fail("The {$attribute} contains forbidden word: {$word}.");
            }
        }
    }
}