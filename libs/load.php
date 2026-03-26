<?php

include_once 'includes/session.class.php';
include_once 'includes/Database.class.php';
include_once 'includes/User.class.php';
include_once 'includes/Mic.class.php';

global $__site_config;
$__site_config = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../database_keys.json');

Session::start();

function get_config($key)
{

    global $__site_config;
    $array = json_decode($__site_config,true);
    if(isset($array[$key]))
        {
            return $array[$key];
        }
        else
            {
                return null;
            }

}

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/app/_template/$name";
}
?>

<?php
function validate_user($username,$password)
    {
        
        if($username=="girithar@gmail.com" and $password=="password")
            {
                return "girithar";
            }
        else
            {
                return false;
            }    
    }

 ?>

 <?php
//  function signup($user, $pass, $email, $phone)
// {
//     $servername = "mysql.selfmade.ninja:3306";
//     $username = "girithar_ff_";
//     $password = "sri9629185073";
//     $dbname = "girithar_ff__webgram";

//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`)
//     VALUES ('$user', '$pass', '$email', '$phone', '1');";
//     $error = false;
//     if ($conn->query($sql) === true) {
//         $error = false;
//     } else {
//         // echo "Error: " . $sql . "<br>" . $conn->error;
//         $error = $conn->error;
//     }

//     $conn->close();
//     return $error;
// }
