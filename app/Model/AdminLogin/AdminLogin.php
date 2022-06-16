<?php

namespace App\Model\AdminLogin;

use App\Lib\Model;
use PDOException;

class AdminLogin extends Model
{

    protected $table = "admin_login";

    protected $fillable = [
        'USERNAME',
        'PHONE_NUMBER',
        'PASSWORD',
        'STATUS',
    ];



    public function authenticate($phoneNumber, $password)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `PHONE_NUMBER`=:phonenumber";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('phonenumber', $phoneNumber);
        $stmt->execute();
        $db_response = $stmt->fetch();

        if ($this->Check_hash($password, $db_response->PASSWORD)) {

            $protected_response = [
                'ADMIN_ID' => $db_response->ADMIN_ID,
                'USERNAME' => $db_response->USERNAME,
                'PHONE_NUMBER' => $db_response->PHONE_NUMBER,

            ];

            return $protected_response;
        } else {
            return false;
        }
    }

    public function check_user_exits($phonenumber)
    {

        $sql = "SELECT * FROM " . $this->table . " WHERE `PHONE_NUMBER`=:phonenumber";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('phonenumber', $phonenumber);

        try {
            $stmt->execute();
            $db_response = $stmt->fetch();
            return $db_response ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    //functions to check if the hash matchs
    private  function Check_hash($password, $hashed_string)
    {
        $new_hash_password = md5($password);
        if ($new_hash_password === $hashed_string) {
            return true;
        } else {
            return false;
        }
    }
}
