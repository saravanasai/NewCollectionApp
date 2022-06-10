<?php

namespace App\Http\Controller\Agents;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Agent\Agent;

class AgentsController extends Controller
{

    public function index(Request $request, Response $response)
    {

        $agents = Agent::make()->all();

        return $response->toJSON(["data" => $agents]);
    }


    public function store(Request $request, Response $response)
    {

        $agents = Agent::make();

        if ($agents->check_agent_exist($request->agent_name)) {
            if ($agents->insert_agent($request)) {

                return $response
                    ->status(201)
                    ->toJSON(["message" => "Agent Created"]);
            }
        }
        return $response
            ->status(422)
            ->toJSON(["message" => "Agent Name Already Exist"]);
    }
}
