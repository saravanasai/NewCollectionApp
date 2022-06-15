<?php

namespace App\Model\Collection;

use App\Lib\Model;
use App\Lib\Request;
use PDOException;

class Collection extends Model
{

    protected $table = "collection_master";

    protected $fillable = [
        'COL_ID',
        'COL_FOR_CUS_ID',
        'COL_PLAN_ID',
        'CUS_TOTAL_DUE',
        'COL_DUE_BALANCE',
        'COL_DUE_LAST_BALANCE',
        'CL_LAST_UPDATED_ON',
        'CL_CREATED_ON'
    ];


    //collection relation 

    public function plan()
    {
        return 'plan_master';
    }


    public function user()
    {
        return 'customer_master';
    }


    public function insert_collection_trigger($last_id, $planid)
    {

        $sql = "SELECT * FROM " . $this->plan() . " WHERE `PL_ID`=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $planid);

        if ($stmt->execute()) {
            $plan_amount_fetch = $stmt->fetchall();

            $planAmount = (number_format($plan_amount_fetch[0]->PL_AMOUNT)) * 12;
            $planId = $plan_amount_fetch[0]->PL_ID;

            $sql = "INSERT INTO `collection_master`(`COL_FOR_CUS_ID`,`COL_PLAN_ID`,`CUS_TOTAL_DUE`, `COL_DUE_BALANCE`)
                        VALUES (
                            '" . $last_id . "',
                            '" . $planId . "',
                            '" . $planAmount . "',
                            '" . $planAmount . "')";
            $stmt = $this->db->prepare($sql);
            if ($stmt->execute()) {
                return true;
            }
        }
    }

    public function filterByPlanAndAmount($planId, $amount)
    {
        $sql = "SELECT * FROM " . $this->table . ",{$this->user()}" . " where `COL_PLAN_ID`={$planId} AND `COL_DUE_BALANCE`<={$amount} AND customer_master.CUS_ID={$this->table}.COL_FOR_CUS_ID";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $db_response = $stmt->fetchAll();
            return $db_response;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function pay($customerId, $amount, $paidBy)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `COL_FOR_CUS_ID`=" . $customerId . " AND `COL_DUE_BALANCE` != 0";
        $stmt = $this->db->prepare($sql);

        if ($stmt->execute()) {

            $collect_data = $stmt->fetchall();
            if (count($collect_data) > 0) {
                $check_bal = $collect_data[0]->COL_DUE_BALANCE;

                if ($check_bal < $amount) { // Checking Existing Loan Amount
                    return false;
                }
                // Updating Due Amount
                $amount_last_balance = $collect_data[0]->COL_DUE_BALANCE;
                $payAmount = $collect_data[0]->COL_DUE_BALANCE - $amount;
                $sql = "UPDATE `collection_master` SET `COL_DUE_BALANCE`=" . $payAmount . ",`COL_DUE_LAST_BALANCE`=" . $amount_last_balance . " WHERE `COL_FOR_CUS_ID`=" . $customerId;
                $stmt = $this->db->prepare($sql);


                return $stmt->execute() ? true : false;
            } else {
                return false; //cannot pay because payed full amount
            }
        }
    }

    public function find($id)
    {
        $sql = "SELECT * FROM " . $this->table . " where `COL_FOR_CUS_ID`={$id}";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $db_response = $stmt->fetch();
            return $db_response;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
