<?php

namespace App\Model\Transaction;

use App\Lib\Model;
use PDOException;

class Transaction extends Model
{


    protected $table = "transaction_master";

    protected $fillable = [
        'TR_ID',
        'TR_OF_CUS',
        'TR_DONE_TO',
        'TR_PAID_AMOUNT',
        'TR_ON_DATE',
        'TR_ON_TIME',
    ];






    public function insert_transaction($customerId, $amount, $paidTo)
    {

        $sql = "INSERT INTO `transaction_master`(`TR_OF_CUS`,`TR_DONE_TO`, `TR_PAID_AMOUNT`)
     VALUES (" . $customerId . "," . $paidTo . "," . $amount . ")";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute() ? true : false;
    }



    public function TodayTransaction()
    {
        $sql = "SELECT * FROM " . $this->table . " JOIN admin_login ON transaction_master.TR_DONE_TO = admin_login.ADMIN_ID WHERE  date(TR_ON_DATE) = current_date";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute();
            $today_data = $stmt->fetchall();
            return $today_data;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function find($id)
    {
        $sql = "SELECT * FROM " . $this->table . " where `TR_OF_CUS`={$id}";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $db_response = $stmt->fetchAll();
            return $db_response;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function transactionBetween($fromDate, $toDate)
    {
        $sql = "SELECT * FROM " . $this->table . " JOIN admin_login ON transaction_master.TR_DONE_TO = admin_login.ADMIN_ID WHERE  date(TR_ON_DATE) BETWEEN '{$fromDate}' AND '{$toDate}'";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $data = $stmt->fetchall();
            return $data;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
