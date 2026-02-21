<?php
function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/app/_template/$name";
}
?>

<?php
function validate_user($username,$password)
    {
        
        if($username=="girithar@gmail.com" and $password=="12345678")
            {
                print("login successsfull");
                return true;
            }
        else
            {
                return false;
            }    
    }