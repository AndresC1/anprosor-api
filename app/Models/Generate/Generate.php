<?php

namespace App\Models\Generate;

class Generate
{
    public static function Password()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*#@$%&_";
        return substr(str_shuffle($chars), 0, 20);
    }
}
