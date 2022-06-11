<?php

namespace App\Http\Controller\Place;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Place\Place;

class PlaceController extends Controller
{



    public function index(Request $request, Response $response)
    {

        $places = Place::make()->all();

        return $response->toJSON(["data" => $places]);
    }


    public function store(Request $request, Response $response)
    {
        $place = Place::make();

        if ($place->check_place_exist($request->place_name)) {
            if ($place->insert_place($request)) {
                return $response
                    ->status(201)
                    ->toJSON(["message" => "Place Created"]);
            }
            return $response
                ->status(500)
                ->toJSON(["message" => "Something went Wrong"]);
        }

        return $response
            ->toJSON(["message" => $request->place_name . " Place Already Exists"]);
    }


    public function delete(Request $request, Response $response)
    {

        if (Place::make()->delete($request->id)) {
            return $response->status(200)->toJSON(["message" => "Place Deleted"]);
        }

        return $response->status(500)->toJSON(["message" => "Something went wrong"]);
    }
}
