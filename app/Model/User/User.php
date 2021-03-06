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


    //user relation 

    public function plan()
    {
        return 'plan_master';
    }


    public function insert_user(Request $request)
    {

        $sql = "INSERT INTO " . $this->table . "(`CUS_NAME`,`CUS_MEMBER_ID` ,`CUS_SUR_NAME`, `CUS_PM_PH_NO`, `CUS_SE_PH_NO`, `CUS_PLACE_ID`, `CUS_REF_BY`, `CUS_PLAN_ID`,`CUS_COM_ONE`,`CUS_SCHEME_ID`)
        VALUES (
            '" . $request->cus_name . "',
            '" . $request->cus_mem_id . "',
            '" . $request->cus_sur_name . "',
            '" . $request->cus_pm_ph_no . "',
            '" . $request->cus_se_ph_no . "',
            '" . $request->cus_place_id . "',
            '" . $request->cus_ref_by . "',
            '" . $request->cus_pl_id . "',
            '" . 0 . "',
            " . $request->cus_sh_id . ")";
        $stmt = $this->db->prepare($sql);

        try {
            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function update(Request $request)
    {

        $sql = "UPDATE " . $this->table . "
        SET
       `CUS_NAME`=:cus_name,
       `CUS_SUR_NAME`=:cus_sur_name,
       `CUS_PM_PH_NO`=:cus_ph_no,
       `CUS_SE_PH_NO`=:cus_se_ph_no,
       `CUS_PLACE_ID`=:cus_place_id,
       `CUS_COM_ONE`=:cus_com_one,
       `CUS_COM_TWO`=:cus_com_two WHERE `CUS_ID`=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('cus_name', $request->cus_name);
        $stmt->bindParam('cus_sur_name', $request->cus_sur_name);
        $stmt->bindParam('cus_ph_no', $request->cus_pm_ph_no);
        $stmt->bindParam('cus_se_ph_no', $request->cus_se_ph_no);
        $stmt->bindParam('cus_place_id', $request->cus_place_id);
        $stmt->bindParam('cus_com_one', $request->cus_com_one);
        $stmt->bindParam('cus_com_two', $request->cus_com_two);
        $stmt->bindParam('id', $request->id);


        try {
            return $stmt->execute() ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function userCountByPlan()
    {

        $sql = "SELECT plan_master.PL_ID,plan_master.PL_AMOUNT,COUNT(CUS_ID) AS TOTAL_USERS FROM " . $this->table . " INNER JOIN plan_master ON plan_master.PL_ID=customer_master.CUS_PLAN_ID GROUP BY customer_master.CUS_PLAN_ID ORDER BY plan_master.PL_ID;";
        $stmt = $this->db->prepare($sql);


        try {
            $stmt->execute();
            $usersByCount = $stmt->fetchall();
            return $usersByCount;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function userCountByPlace()
    {

        $sql = "SELECT place_master.PLACE_ID,place_master.PLACE_NAME,COUNT(CUS_ID) AS TOTAL_USERS FROM " . $this->table . " INNER JOIN place_master ON place_master.PLACE_ID=customer_master.CUS_PLACE_ID GROUP BY customer_master.CUS_PLACE_ID ORDER BY place_master.PLACE_NAME;";
        $stmt = $this->db->prepare($sql);


        try {
            $stmt->execute();
            $usersByCount = $stmt->fetchall();
            return $usersByCount;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function userCountByAgent()
    {

        $sql = "SELECT agent_master.AGENT_ID,agent_master.AGENT_NAME ,COUNT(CUS_ID) AS TOTAL_USERS FROM " . $this->table . " INNER JOIN agent_master ON agent_master.AGENT_ID=customer_master.CUS_REF_BY  GROUP BY customer_master.CUS_REF_BY ORDER BY agent_master.AGENT_NAME;";
        $stmt = $this->db->prepare($sql);


        try {
            $stmt->execute();
            $usersByCount = $stmt->fetchall();
            return $usersByCount;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM " . $this->table . ",plan_master,place_master,agent_master WHERE `CUS_PLACE_ID`=place_master.PLACE_ID AND `CUS_REF_BY`= agent_master.AGENT_ID AND `CUS_PLAN_ID`=plan_master.PL_ID; ";
        $stmt = $this->db->prepare($sql);


        try {
            $stmt->execute();
            $all_agents_fetched = $stmt->fetchall();
            return $all_agents_fetched;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function searchCustomer($key)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `CUS_NAME` like '%" . $key . "%' OR `CUS_PM_PH_NO` like '%" . $key . "%' OR `CUS_MEMBER_ID` like '%" . $key . "%' ORDER BY CUS_MEMBER_ID";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute();
            $customer_fetched = $stmt->fetchall();
            return $customer_fetched;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function find($id)
    {

        $sql = "SELECT *
         FROM " . $this->table . ",plan_master,place_master,agent_master,collection_master WHERE `CUS_PLACE_ID`=place_master.PLACE_ID AND `CUS_REF_BY`= agent_master.AGENT_ID AND `CUS_PLAN_ID`=plan_master.PL_ID AND `CUS_ID`=:id AND `COL_FOR_CUS_ID`=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('id', $id);

        try {
            $stmt->execute();
            $single_customer_fetched = $stmt->fetch();

            return $single_customer_fetched;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
