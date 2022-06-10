<?php

namespace App\Lib;


class Model 
{

    public $db;
    

    public function __construct()
    {
        $this->db=App::$Db;

        return $this;
    }


    public static function make()
    {

        return new static();
    }

    
}