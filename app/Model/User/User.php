<?php

namespace App\Model\User;

use App\Lib\Model;
use App\Lib\Request;
use PDOException;

class User extends Model
{


    protected $table = "customer_master";

    protected $fillable = [
        'CUS_ID',
        'CUS_MEMBER_ID',
        'CUS_NAME',
        'CUS_SUR_NAME',
        'CUS_PM_PH_NO',
        'CUS_SE_PH_NO',
        'CUS_PLACE_ID',
        'CUS_REF_BY',
        'CUS_PLAN_ID',
        'CUS_DL_STATUS',
        'CUS_COM_ONE',
        'CUS_COM_TWO',
        'CUS_CREATED_AT',
        'CUS_SCHEME_ID',
        
    ];




    public function insert_user(Request $request)
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
        $sql="SELECT * FROM ".$this->table.",plan_master,place_master,agent_master WHERE `CUS_PLACE_ID`=place_master.PLACE_ID AND `CUS_REF_BY`= agent_master.AGENT_ID AND `CUS_PLAN_ID`=plan_master.PL_ID; ";
        $stmt=$this->db->prepare($sql);


        try{
         $stmt->execute();
         $all_agents_fetched=$stmt->fetchall();
         return $all_agents_fetched;
        }
        catch(PDOException $e)
        {
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
