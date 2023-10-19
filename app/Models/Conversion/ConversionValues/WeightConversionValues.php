<?php

namespace App\Models\Conversion\ConversionValues;

class WeightConversionValues
{
    public static $conversionValue = [
        'kg' => [
            'kg' => 1,
            'ton' => 0.001,
            'qq' => 0.01,
        ],
        'ton' => [
            'kg' => 1000,
            'ton' => 1,
            'qq' => 10,
        ],
        'qq' => [
            'kg' => 100,
            'ton' => 0.1,
            'qq' => 1,
        ]
    ];
}
