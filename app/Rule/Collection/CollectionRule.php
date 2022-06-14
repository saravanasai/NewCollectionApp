<?php 

namespace App\Rule\Collection;

use App\Lib\Contracts\Rule;
use App\Lib\Request;

class CollectionRule extends Rule
{

    public static $errors = [];

    public static function validate(Request $request): array
    {

        if (Rule::Required($request->amount)) {
            static::$errors['amount'] = "Amount is Required";
        }


        if (Rule::IsNumeric($request->amount)) {
            static::$errors['amount'] = "Amount Should be Numeric";
        }


        if (Rule::IsNumeric($request->paidBy)) {
            static::$errors['paidBy'] = "Paid By Should be Numeric";
        }

        return static::$errors;
    }

}