<?php

namespace App\Lib\Contracts;


abstract class Rule
{

    public static function IsNumeric($value): bool
    {
        return is_numeric($value) ? true : false;
    }
}
