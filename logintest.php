<?php
include 'libs/load.php';

$user = "priya";
$pass = "giri";
$result = null;

if (isset($_GET['logout'])) {
    Session::destroy();
    die("Session destroyed, <a href='logintest.php'>Login Again</a>");
}

if (Session::get('is_loggedin')) {
    $userdata = Session::get('session_user');
    print("Welcome Back, $userdata[username]");
    $result = $userdata;
} else {
    printf("No session found, trying to login now. <br>");
    $result = User::login($user, $pass);
    if ($result) {
        echo "Login Success, $result[username]";
        Session::set('is_loggedin', true);
        Session::set('session_user', $result);
    } else {
        echo "Login failed <br>";
    }
}
echo <<<EOL
<br><br><a href="logintest.php?logout">Logout</a>
EOL;
