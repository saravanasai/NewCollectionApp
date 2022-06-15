<?php

namespace App\Lib;

class Response
{
    private $status = 200;

    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }
    
    public function toJSON($data = [])
    {
        http_response_code($this->status);
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($data,JSON_INVALID_UTF8_IGNORE);
    }
}