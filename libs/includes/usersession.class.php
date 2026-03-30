<?php
class usersession
{
    public static function authenticate($username,$password)
    {
        $username = User::login($username.$password);
        $user = new User($username);
        if($username)
            {
                $conn = Database::getConnection();
                $ip = $__SERVER['REMOTE_ADDR'];
                $user_agent = $__SERVER['HTTP_USER_AGENT'];
                $token = md5(rand(0,99999).$username.$ip.$user_agent);
                $sql = "INSERT INTO 'sessions'('uid','token','ip','user_agent','login_time','active') 
                VALUES ('$this-> id','$token','$ip','$user_agent',now(),'1')";
                if($conn->query($sql)== true)
                    {
                        Session::set('token',$token);
                        return $token;
                    }
                    else{
                        return false;
                    }
            }
            else{
                return false;

            }    
    }
    public static function athurize($token)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `sessions` WHERE `token`='$token' AND `active`='1'";
        $result = $conn->query($sql);
        if($result->num_rows == 1)
            {
                return true;
            }
            else
                {
                    return false;
                }
    }
    public function __construct($token)
    {
    $conn = Database::getconnection();
    $this->token = $token;
    $this->date = null;
    $sql = "SELECT * FROM 'sessions' WHERE 'token'= '$token' LIMIT 1";
    $restult = $conn->query($sql);
    if($result->num_rows)
        {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid'];


        }
    else{
        throw new Exception("invalid session token");

    }    
    
    }
    public static function getuser()
    {
        return new User ($this->uid);

    }
    public static function getip()
    {
        return $this->data['ip'];
    }
    public static function isvalid()
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM 'sessions' WHERE 'token'='$this->token' AND 'active'='1'";
        $result = $conn->query($sql);
        if($result->num_rows == 1)
            {
                return true;
            }
            else
                {
                    return false;
                }
    }
}