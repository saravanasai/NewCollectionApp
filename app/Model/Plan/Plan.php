<?php

namespace App\Model\Plan;

use App\Lib\Model;
use App\Lib\Request;
use PDOException;

class Plan extends Model
{

    protected $table = "plan_master";

    protected $fillable = [
        'PL_ID',
        'PL_AMOUNT',
    ];




    public function insert_place(Request $request)
    {

        $sql = "INSERT INTO " . $this->table . "(`PL_AMOUNT`) VALUES ('" . $request->plan_amount . "')";
        $stmt = $this->db->prepare($sql);
        try {
            return $stmt->execute() ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function check_plan_exist($plan)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE PL_AMOUNT='" . $plan . "'";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $response = $stmt->fetchall();
            return (count($response) > 0) ? false : true;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function all()
    {
        $sql = "SELECT * FROM " . $this->table . "";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $db_response = $stmt->fetchAll();
            return $db_response;
        } catch (PDOException $e) {
            echo $e;
        }
    }

}
