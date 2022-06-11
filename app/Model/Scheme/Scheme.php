<?php

namespace App\Model\Scheme;

use App\Lib\Model;
use App\Lib\Request;
use PDOException;

class Scheme extends Model
{


    protected $table = "scheme_master";

    protected $fillable = [
        'SCHEME_ID',
        'SCHEME_NAME',
        'SCHEME_START_DATE',
        'SCHEME_END_DATE',
        'SCHEME_ACTIVE_STATUS',
        'SCHEME_DL_STATUS',
    ];




    public function insert_scheme(Request $request)
    {

        $sql = "INSERT INTO " . $this->table . "(`SCHEME_NAME`,`SCHEME_START_DATE`,`SCHEME_END_DATE`) VALUES (:schemen_name,:fromdate,:todate)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('schemen_name', $request->SCHEME_NAME);
        $stmt->bindParam('fromdate', $request->SCHEME_START_DATE);
        $stmt->bindParam('todate', $request->SCHEME_END_DATE);

        try {
            return $stmt->execute() ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }



    public function all()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `SCHEME_DL_STATUS`=1 AND `SCHEME_ACTIVE_STATUS`=1";
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
        $sql = "UPDATE " . $this->table . " SET `SCHEME_DL_STATUS`=0 WHERE `SCHEME_ID`=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
        try {

            return $stmt->execute() ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
