<?php

namespace App\Http\Controller;

use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;


class HomeController extends Controller
{

    public function index(Request $request, Response $response)
    {   

        var_dump($request);
            return $request;
    }


    public function about(Request $request, Response $response)
    {
        
        

           

    }


}
