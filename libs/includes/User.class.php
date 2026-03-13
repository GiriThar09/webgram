<?php
class User
{
    private $conn;
    
    public static function signup($user, $pass, $email, $phone)
    {
        $pass = md5(strrev($pass));
        $conn = Database::getconnection();
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`)
                VALUES ('$user', '$pass', '$email', '$phone', '1')";
        
        $error = false;
        if ($conn->query($sql) === true) {
            $error = false;
        } else {
            $error = $conn->error;
        }
        
        return $error;
    }
    public static function login($user,$pass)
    {
        $pass = md5(strrev($pass));
        $query = "SELECT * FROM `auth` WHERE `username` = '$user'";
        $conn = Database::getConnection();
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row['password'] == $pass) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }


    }

 

    public function __construct($username)
    {
        $this->conn = Database::getConnection();
    }
}
