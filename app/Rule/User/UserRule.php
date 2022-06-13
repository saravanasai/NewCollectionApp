<?php

namespace App\Rule\User;

use App\Lib\Contracts\Rule;
use App\Lib\Request;

class UserRule extends Rule
{

    public static $errors = [];



    public static function validate(Request $request): array
    {

        if (Rule::Required($request->cus_name)) {
            static::$errors['cus_name'] = "Customer Name is Required";
        }

        if (Rule::Required($request->cus_pm_ph_no)) {
            static::$errors['cus_pm_ph_no'] = "Customer Phone Number is Required";
        }

        if (Rule::IsNumeric($request->cus_pm_ph_no)) {
            static::$errors['cus_pm_ph_no'] = "Customer Phone Number must be numeric";
        }

        if (Rule::LessThan($request->cus_pm_ph_no, 10)) {
            static::$errors['cus_pm_ph_no'] = "Customer Phone Number Must be  10 digits";
        }

        if (Rule::GreaterThan($request->cus_pm_ph_no, 10)) {
            static::$errors['cus_pm_ph_no'] = "Customer Phone Number Must be only 10 digits";
        }

        if (Rule::IsNumeric($request->cus_mem_id)) {
            static::$errors['cus_mem_id'] = "Customer Member Id  Must be Numeric";
        }

        if (Rule::Required($request->cus_mem_id)) {
            static::$errors['cus_mem_id'] = "Customer Member Id  is Required";
        }

        if (Rule::IsUnique('CUS_MEMBER_ID', 'customer_master',$request->cus_mem_id)) {

            static::$errors['cus_mem_id'] = "Customer Member Id  Already Exists";
        }

        if (Rule::Required($request->cus_place_id)) {
            static::$errors['cus_place_id'] = "Customer Place  is Required";
        }
        if (Rule::IsNumeric($request->cus_place_id)) {
            static::$errors['cus_place_id'] = "Customer Place ID Must be Numeric";
        }
        if (Rule::Required($request->cus_ref_by)) {
            static::$errors['cus_ref_by'] = "Refered by Value is Required";
        }
        if (Rule::IsNumeric($request->cus_ref_by)) {
            static::$errors['cus_ref_by'] = "Refered by Id Must be Numeric";
        }

        if (Rule::Required($request->cus_pl_id)) {
            static::$errors['cus_pl_id'] = "Plan is Required";
        }

        if (Rule::IsNumeric($request->cus_pl_id)) {
            static::$errors['cus_pl_id'] = "Plan Id must be Numeric";
        }

        if (Rule::Required($request->cus_sh_id)) {
            static::$errors['cus_sh_id'] = "Scheme is Required";
        }

        if (Rule::IsNumeric($request->cus_sh_id)) {
            static::$errors['cus_sh_id'] = "Scheme id Must be numeric";
        }

        return static::$errors;
    }



    public static function validateUpdate(Request $request): array
    {

        if (Rule::Required($request->cus_name)) {
            static::$errors['cus_name'] = "Customer Name is Required";
        }

        if (Rule::Required($request->cus_pm_ph_no)) {
            static::$errors['cus_pm_ph_no'] = "Customer Phone Number is Required";
        }

        if (Rule::IsNumeric($request->cus_pm_ph_no)) {
            static::$errors['cus_pm_ph_no'] = "Customer Phone Number must be numeric";
        }

        if (Rule::LessThan($request->cus_pm_ph_no, 10)) {
            static::$errors['cus_pm_ph_no'] = "Customer Phone Number Must be  10 digits";
        }

        if (Rule::GreaterThan($request->cus_pm_ph_no, 10)) {
            static::$errors['cus_pm_ph_no'] = "Customer Phone Number Must be only 10 digits";
        }

        if (Rule::Required($request->cus_place_id)) {
            static::$errors['cus_place_id'] = "Customer Place  is Required";
        }
        if (Rule::IsNumeric($request->cus_place_id)) {
            static::$errors['cus_place_id'] = "Customer Place ID Must be Numeric";
        }
       
        return static::$errors;
    }
}
