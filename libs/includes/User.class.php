<?php
class User
{
    private $conn;
    
    public static function signup($user, $pass, $email, $phone)
    {
        // $pass = md5(strrev(md5($pass)));
        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($pass,PASSWORD_DEFAULT);
        $conn = Database::getconnection();
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`)
                VALUES (?, ?, ?, ?, '1')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $user, $pass, $email, $phone);
        
        $error = false;
        if ($stmt->execute()) {
            $error = false;
        } else {
            $error = $stmt->error;
        }
        
        $stmt->close();
        return $error;
    }
    public static function login($user,$pass)
    {
        // $pass = md5(strrev(md5($pass)));
        $conn = Database::getconnection();
        $sql = "SELECT * FROM `auth` WHERE `username` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password'])) {
                $stmt->close();
                return $row;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            return false;
        }
    }

 

    public function __construct($username)
    {
            $this->conn = Database::getConnection();
    }
    public function setbio()
    {

    }
    public function getbio()
    {

    }
    // public function authendicate($username, $password)
    // {
    //     $query = "SELECT * FROM `auth` WHERE `username` = '$username'";
    //     $result = $this->conn->query($query);
    //     if ($result->num_rows == 1) {
    //         $row = $result->fetch_assoc();
    //         if (password_verify($password, $row['password'])) {
    //             return $row;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }
}

