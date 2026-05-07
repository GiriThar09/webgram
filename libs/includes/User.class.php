<?php

require_once "Database.class.php";

class User
{
    private $conn;

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        }
        else{
            throw new Exception("Function does not exist");
        }
    }
    
    public static function signup($user, $pass, $email, $phone)
    {
        $username = trim($user);
        $email = trim($email);
        $phone = trim($phone);
        $password = trim($pass);

        if ($username === '' || $email === '' || $password === '') {
            return 'Username, email and password are required.';
        }

        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM `auth` WHERE `email` = ? OR `username` = ?");
        if (!$stmt) {
            return $conn->error;
        }
        $stmt->bind_param('ss', $email, $username);
        $stmt->execute();
        $stmt->bind_result($userCount);
        $stmt->fetch();
        $stmt->close();

        if ($userCount > 0) {
            return 'A user with that email or username already exists.';
        }

        $options = ['cost' => 9];
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt = $conn->prepare("INSERT INTO `auth` (`username`, `password`, `email`, `phone`) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            return $conn->error;
        }
        $stmt->bind_param('ssss', $username, $passwordHash, $email, $phone);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $error = $stmt->error ?: $conn->error;
        $stmt->close();
        return $error;
    }

    public static function login($email, $pass)
    {
        $conn = Database::getConnection();
        $email = $conn->real_escape_string($email);
        $query = "SELECT * FROM `auth` WHERE `email` = '$email' LIMIT 1";
        $result = $conn->query($query);
        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password'])) {
                return $row;
            }
        }
        return false;
    }

    public function __construct($username)
    {
        $this->conn = Database::getConnection();
        $this->username = $username;
        $this->id = null;
        $sql = "SELECT `id` FROM `auth` WHERE `username` = ? OR `id` = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Unable to prepare user lookup: ' . $this->conn->error);
        }
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $stmt->bind_result($id);
        if ($stmt->fetch()) {
            $this->id = $id;
            $stmt->close();
            return;
        }
        $stmt->close();
        throw new Exception("Username doesn't exist");
    }

    //this function helps to retrieve data from the database
    private function _get_data($var)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "SELECT `$var` FROM `users` WHERE `id` = $this->id";
        //print($sql);
        $result = $this->conn->query($sql);
        if ($result and $result->num_rows == 1) {
            //print("Res: ".$result->fetch_assoc()["$var"]);
            return $result->fetch_assoc()["$var"];
        } else {
            return null;
        }
    }

    //This function helps to  set the data in the database
    private function _set_data($var, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "UPDATE `users` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function setDob($year, $month, $day)
    {
        if (checkdate($month, $day, $year)) { //checking data is valid
            return $this->_set_data('dob', "$year.$month.$day");
        } else {
            return false;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function authenticate()
    {
        $token = bin2hex(random_bytes(16));
        $ip = $_SERVER['REMOTE_ADDR'];
        $conn = Database::getConnection();
        $sql = "INSERT INTO `sessions` (`uid`, `token`, `ip`, `active`) VALUES ('$this->id', '$token', '$ip', '1')";
        if($conn->query($sql)== true)
            {
                Session::set('token',$token);
                return $token;
            }
            else{
                return false;
            }
    }

}