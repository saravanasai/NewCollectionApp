<?php

namespace App\Lib\View;



class View
{


    public static ?View  $instance = null;

    public  $viewString;


    private function __construct($path, array $data = [])
    {

        ob_start();

        extract($data);

        include(__DIR__ . "/../../../resource/view/" . $path . ".php");

        $this->viewString = ob_get_clean();

        $this->resolve();
    }

    public static function make($path, array $data = []): self
    {

        if (self::$instance == null) {

            return new self($path, $data);
        }

        return self::$instance;
    }



    public  function resolve()
    {
        print_r($this->viewString);
    }
}
