<?php 

namespace App\Http\Controller\Search;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\User\User;

class SearchController extends Controller
{


    public function search(Request $request,Response $response)
    {   

        $users=User::make()->searchCustomer($request->key);

        return $response->toJSON(["data"=>$users]);
    }



}