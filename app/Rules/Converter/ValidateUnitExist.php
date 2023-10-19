<?php

namespace App\Rules\Converter;

use App\Models\Conversion\ConversionValues\WeightConversionValues;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateUnitExist implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $units = array_merge(
            array_keys(WeightConversionValues::$conversionValue),
        );
        
        if (!in_array($value, $units)) {
            $fail('La unidad de medida '.$value.' no existe');
        }
    }
}
