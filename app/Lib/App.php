<?php


namespace App\Lib;
use \PDO;
use PDOException;

class App extends ServiceProvider
{

    public static  $Db;

    public function  __construct($servername, $dbname, $username, $password)
    {   

        $defaults=[PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];

        try {
            static::$Db =  new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$defaults);
            // set the PDO error mode to exception
            $this->boot();
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }





    public static function DB(): \PDO
    {
        return static::$Db;
    }
}
