<?php
function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/app/_template/$name";
}
?>

<?php
function validate_user($username,$password)
    {
        print("Login successful");
        if($username=="girithar@gmail.com" and $password=="12345678")
            {
                return true;
            }
        else
            {
                return false;
            }    
    }