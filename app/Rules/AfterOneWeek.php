<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterOneWeek implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Comprueba si la fecha proporcionada es al menos una semana después de la fecha actual
        return Carbon::parse($value)->gte(Carbon::now()->addWeek());
    }

    public function message()
    {
        return 'The :attribute must be a date at least one week after the current date.';
    }
}
