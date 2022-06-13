<?php

namespace App\Model\Collection;

use App\Lib\Model;
use App\Lib\Request;

class Collection extends Model
{

    protected $table = "collection_master";

    protected $fillable = [
        'COL_ID',
        'COL_FOR_CUS_ID',
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



    public function insert_collection($last_id, $planid)
    {

        $sql = "SELECT * FROM " . $this->plan() . " WHERE `PL_ID`=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $planid);

        if ($stmt->execute()) {
            $plan_amount_fetch = $stmt->fetchall();

            $planAmount = (number_format($plan_amount_fetch[0]->PL_AMOUNT)) * 12;

            $sql = "INSERT INTO `collection_master`(`COL_FOR_CUS_ID`, `CUS_TOTAL_DUE`, `COL_DUE_BALANCE`)
                        VALUES (
                            '" . $last_id . "',
                            '" . $planAmount . "',
                            '" . $planAmount . "')";
            $stmt = $this->db->prepare($sql);
            if ($stmt->execute()) {
                return true;
            }
        }
    }
}
