<?php

namespace App\Lib;

use PDOException;

class Model
{

    public $db;

    protected $table = "";

    protected $fillable = [];

    public function __construct()
    {
        $this->db = App::$Db;

        return $this;
    }


    public static function make()
    {

        return new static();
    }


    public function all()
    {
        $sql = "SELECT * FROM " . $this->table . "";
        $stmt = $this->db->prepare($sql);


        try {
            $stmt->execute();
            $all_agents_fetched = $stmt->fetchall();
            return $all_agents_fetched;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function unique($feild, $table, $value)
    {

        $sql = "select {$feild} from {$table} where {$feild}={$value}";

        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $response = $stmt->fetchall();

            return (count($response) > 0) ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }



    public function latest($feild)
    {
        $sql = "select {$feild} from {$this->table}  ORDER BY {$feild}  DESC";

        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $response = $stmt->fetchAll();
                
            return $response[0]->$feild;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
