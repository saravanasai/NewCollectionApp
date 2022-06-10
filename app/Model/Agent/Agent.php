<?php

namespace App\Model\Agent;

use App\Lib\Model;
use App\Lib\Request;
use PDO;
use PDOException;

class Agent extends Model
{

    protected $table = "agent_master";

    protected $fillable = [
        'AGENT_NAME',
        'AGENT_PH_NO',
        'AGENT_LOCATION',
        'AGENT_DL_STATUS',
    ];


    //user relations 

    public function location()
    {

        return 'place_master';
    }

    public function insert_agent(Request $request)
    {

        $sql = "INSERT INTO " . $this->table . "(`AGENT_NAME`,`AGENT_PH_NO`,`AGENT_LOCATION`) VALUES ('" . $request->agent_name . "','" . $request->agent_ph_no . "','" .  $request->agent_location . "')";
        $stmt = $this->db->prepare($sql);
        try {
            return $stmt->execute() ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function check_agent_exist($agentName)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE  AGENT_NAME ='" . $agentName . "' AND `AGENT_DL_STATUS`=1";
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
        $sql = "SELECT * FROM " . $this->table;
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
