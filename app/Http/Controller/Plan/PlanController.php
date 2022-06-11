<?php

namespace App\Http\Controller\Plan;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Plan\Plan;
use App\Rule\Plan\PlanRule;

class PlanController extends Controller
{

    public function index(Request $request, Response $response)
    {

        $plans = Plan::make()->all();

        return $response->toJSON(["data" => $plans]);
    }


    public function store(Request $request, Response $response)
    {
        $plan = Plan::make();

        if (PlanRule::IsNumeric($request->plan_amount)) {
            if ($plan->check_plan_exist($request->plan_amount)) {
                if ($plan->insert_place($request)) {
                    return $response
                        ->status(201)
                        ->toJSON(["message" => "Plan Created"]);
                }
                return $response
                    ->status(500)
                    ->toJSON(["message" => "Something went Wrong"]);
            }

            return $response
                ->toJSON(["message" => $request->plan_amount . " Plan Already Exists"]);
        }

        return $response
            ->toJSON(["message" => "Plan Amount Must Be Numeric"]);
    }


}
