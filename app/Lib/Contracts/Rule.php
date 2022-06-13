<?php

namespace App\Lib\Contracts;

use App\Lib\Model;

abstract class Rule
{

    public static function IsNumeric($value): bool
    {
        return !is_numeric($value) ? true : false;
    }

    public static function IsUnique($feild, $table, $value): bool
    {
        $is_unique = (new Model())->unique(
            $feild,
            $table,
            $value
        );
        return  $is_unique ? true : false;
    }

    public static function Required($value): bool
    {
        return (empty($value)) ? true : false;
    }

    public static function GreaterThan($value, $max): bool
    {
        return  strlen($value) > $max ? true : false;
    }

    public static function LessThan($value, $max): bool
    {
        return  strlen($value) < $max ? true : false;
    }
}
