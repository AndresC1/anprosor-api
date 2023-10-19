<?php

namespace App\Models\Conversion\ConversionValues;

class WeightConversionValues
{
    public static $conversionValue = [
        'kg' => [
            'kg' => 1,
            'ton' => 0.001,
            'qq' => 0.0220462,
        ],
        'ton' => [
            'kg' => 1000,
            'ton' => 1,
            'qq' => 22.0462,
        ],
        'qq' => [
            'kg' => 45.3592,
            'ton' => 0.0453592,
            'qq' => 1,
        ]
    ];
}
