<?php

namespace App\Http\Controller\User;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Collection\Collection;
use App\Model\User\User;
use App\Rule\User\UserRule;

class UserController extends Controller
{

    public function index(Request $request, Response $response)
    {

        $users = User::make()->all();

        return $response->toJSON(["data" => $users]);
    }


    public function store(Request $request, Response $response)
    {
        $user = User::make();

        $errors = UserRule::validate($request);

        if (!$errors) {
            if ($user->insert_user($request)) {

                $lastid = User::make()->latest('CUS_ID');

                $collection = Collection::make();

                if ($collection->insert_collection_trigger($lastid, $request->cus_pl_id)) {
                    return $response
                        ->status(201)
                        ->toJSON(["message" => "User Created"]);
                }
            }
            return $response
                ->status(500)
                ->toJSON(["message" => $request]);
        }

        return $response
            ->status(422)
            ->toJSON(["errors" => $errors]);
    }


    public function show(Request $request, Response $response)
    {

        $user_info = User::make()->find($request->id);

        return $response
            ->status(200)
            ->toJSON(["message" => $user_info]);
    }

    public function update(Request $request, Response $response)
    {

        $errors = UserRule::validateUpdate($request);

        if ($errors==[]) {

            $user = User::make();
            
            if ($user->update($request)) {

                return $response
                    ->status(201)
                    ->toJSON(["message" => "User Information Updated"]);
            }
        }

        return $response
            ->status(422)
            ->toJSON(["errors" => $errors]);
    }
}
