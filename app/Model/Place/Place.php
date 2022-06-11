<?php

namespace App\Model\Place;

use App\Lib\Model;
use App\Lib\Request;
use PDOException;

class Place extends Model
{


    protected $table = "place_master";

    protected $fillable = [
        'PLACE_ID',
        'PLACE_NAME',
        'PLACE_DL_STATUS'
    ];




    public function insert_place(Request $request)
    {

        $sql = "INSERT INTO " . $this->table . "(`PLACE_NAME`) VALUES ('" . $request->place_name . "')";
        $stmt = $this->db->prepare($sql);
        try {
            return $stmt->execute() ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function check_place_exist($placeName)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE PLACE_NAME='" . $placeName . "' AND PLACE_DL_STATUS=1";
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
        $sql = "SELECT * FROM " . $this->table . " WHERE `PLACE_DL_STATUS`=1";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $db_response = $stmt->fetchAll();
            return $db_response;
        } catch (PDOException $e) {
            echo $e;
        }
    }



    public function delete($id)
    {
        $sql = "UPDATE " . $this->table . " SET `PLACE_DL_STATUS`=0 WHERE `PLACE_ID`=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('id', $id);

        try {

            return ($stmt->execute()) ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
