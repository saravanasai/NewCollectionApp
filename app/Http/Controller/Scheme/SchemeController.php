<?php

namespace App\Http\Controller\Scheme;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Scheme\Scheme;

class SchemeController extends Controller
{

    public function index(Request $request, Response $response)
    {

        $schemes = Scheme::make()->all();

        return $response->toJSON(["data" => $schemes]);
    }


    public function store(Request $request, Response $response)
    {
        $scheme = Scheme::make();

        if ($scheme->insert_scheme($request)) {
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

        if (Scheme::make()->delete($request->id)) {
            return $response->status(200)->toJSON(["message" => "Scheme Deleted"]);
        }

        return $response->status(500)->toJSON(["message" => "Something went wrong"]);
    }
}
