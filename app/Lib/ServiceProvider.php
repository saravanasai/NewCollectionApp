<?php 

namespace App\Lib;


class ServiceProvider{



    public $routes=[
        ["fileName"=>"web"],
    ];

    public const ROUTE_PATH=__DIR__."../../../routes/";

    public function boot()
    {

        foreach ($this->routes as $key => $value) {
           
            
            require_once(self::ROUTE_PATH."{$value['fileName']}".".php");

        }

    }


    public function register()
    {


        
    }

}