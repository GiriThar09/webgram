<?php
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
                print("login successsfull");
                return true;
            }
        else
            {
                return false;
            }    
    }

 ?>

 <?php
 function signup($user, $pass, $email, $phone)
{
    $servername = "mysql.selfmade.ninja:3306";
    $username = "girithar_ff_";
    $password = "sri9629185073";
    $dbname = "girithar_ff__webgram";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`)
    VALUES ('$user', '$pass', '$email', '$phone', '1');";
    $error = false;
    if ($conn->query($sql) === true) {
        $error = false;
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        $error = $conn->error;
    }

    $conn->close();
    return $error;
}
