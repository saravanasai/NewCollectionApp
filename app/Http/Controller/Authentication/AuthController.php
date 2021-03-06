<?php

namespace App\Http\Controller\Authentication;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\AdminLogin\AdminLogin;

class AuthController extends Controller
{

    public function login(Request $request, Response $response)
    {

        $adminLogin = AdminLogin::make();

        if ($adminLogin->check_user_exits($request->phonenumber)) {

            $auth=$adminLogin->authenticate($request->phonenumber, $request->password);

            if ($auth) {
              
                return $response
                ->status(200)
                ->toJSON(["message" => "Authentication Success","data"=>$auth]);
            }

            return $response
            ->status(401)
            ->toJSON(["message" => "UnAutheroized Action"]);
        }

        return $response
        ->status(404)
        ->toJSON(["message" => "User Not Found"]);
    }


   
}
