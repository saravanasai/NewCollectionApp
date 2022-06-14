<?php

namespace App\Http\Controller\Collection;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Collection\Collection;
use App\Model\Transaction\Transaction;
use App\Rule\Collection\CollectionRule;

class CollectionController extends Controller
{


    public function pay(Request $request, Response $response)
    {

        $errors = CollectionRule::validate($request);

        if (!$errors) {

            $collection = Collection::make();

            if ($collection->pay($request->id, $request->amount, $request->paidBy)) {

                if(Transaction::make()->insert_transaction($request->id, $request->amount, $request->paidBy))
                {
                    return $response->status(201)->toJSON(["message" => "Due Amount Paid"]);
                }

                return $response->status(500)->toJSON(["message" => "Something went wrong"]);
            }

            return $response->status(200)->toJSON(["message" => "No Balance Due Amount"]);
        }

        return $response->status(422)->toJSON(["data" => $errors]);
    }


    public function show(Request $request,Response $response)
    {
        $collection = Collection::make()->find($request->id);

         return $response->toJSON(["data"=>$collection]);

    }
}
