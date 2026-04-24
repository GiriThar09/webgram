<?php
class usersession
{
    public static function authenticate($username,$password)
    {
        $username = User::login($username, $password);
        if($username)
        {
            $user = new User($username);
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'cli';
            $token = md5(rand(0,99999).$username.$ip.$user_agent);
            $uid = property_exists($user, 'id') ? $user->id : ($user->uid ?? '0');
                 $sql = "INSERT INTO session(uid,token,ip,user_agent,login_time,active) VALUES ('$uid','$token','$ip','$user_agent',now(),'1')";
            if($conn->query($sql) === true)
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
        $sql = "SELECT * FROM `session` WHERE `token`='$token' AND `active`='1'";
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
    $conn = Database::getConnection();
    $this->token = $token;
    $this->date = null;
    $sql = "SELECT * FROM `session` WHERE `token`= '$token' LIMIT 1";
    $result = $conn->query($sql);
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
    public function getuser()
    {
        return new User ($this->uid);

    }
    public function getip()
    {
        return $this->data['ip'];
    }
    public function isvalid()
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `session` WHERE `token`='" . $this->token . "' AND `active`='1'";
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