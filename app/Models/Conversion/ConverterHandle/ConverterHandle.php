<?php

namespace App\Models\Conversion\ConverterHandle;

use App\Models\Conversion\ConverterHandleInterface;
use App\Models\Conversion\TypeConversion\WeightConversionHandle;

class ConverterHandle implements ConverterHandleInterface
{
    private $nextHandle;

    public function __construct()
    {
        $this->setNext();
    }

    public function setNext(): void
    {
        $this->nextHandle = new WeightConversionHandle();
    }

    public function convert($amount, $from, $to)
    {
        return $this->nextHandle->convert($amount, $from, $to);
    }
}
