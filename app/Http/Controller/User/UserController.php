<?php

namespace App\Http\Controller\User;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\User\User;

class UserController extends Controller
{

    public function index(Request $request, Response $response)
    {

        $users = User::make()->all();

        return $response->toJSON(["data" => $users]);
    }


    public function store(Request $request, Response $response)
    {
        $scheme = User::make();

        if ($scheme->insert_user($request)) {
            return $response
                ->status(201)
                ->toJSON(["message" => "Scheme Created"]);
        }
        return $response
            ->status(500)
            ->toJSON(["message" => $request]);
    }


    public function delete(Request $request, Response $response)
    {

        if (User::make()->delete($request->id)) {
            return $response->status(200)->toJSON(["message" => "Scheme Deleted"]);
        }

        return $response->status(500)->toJSON(["message" => "Something went wrong"]);
    }
}
