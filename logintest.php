<?php
include 'libs/load.php';

$user = "navya";
$pass = "giri";
$result = null;

if (isset($_GET['logout'])) {
    Session::destroy();
    die("Session destroyed, <a href='logintest.php'>Login Again</a>");
}

// 1. Check if session_token in PHP session is available
$session_token = Session::get('session_token');

if ($session_token) {
    try {
        // 2. If yes, construct UserSession and see if its successful
        $usersession = new usersession($session_token);
        
        // 3. Check if the session is valid one
        if (usersession::athurize($session_token)) {
            // 4. If valid, print "Session validated"
            echo "Session validated<br>";
            $username = Session::get('session_username');
            $userobj = new User($username);
            print("Welcome Back ".$userobj->getFirstname());
            print("<br>".$userobj->getBio());
            $userobj->setBio("Making new things...");
            print("<br>".$userobj->getBio());
        } else {
            // 5. Else, print "Invalid Session" and ask user to login
            echo "Invalid Session<br>";
            printf("Session expired. <a href='logintest.php'>Login Again</a>");
        }
    } catch (Exception $e) {
        // 5. Else, print "Invalid Session" and ask user to login
        echo "Invalid Session: " . $e->getMessage() . "<br>";
        printf("<a href='logintest.php'>Please Login</a>");
    }
} else {
    printf("No session found, trying to login now. <br>");
    $result = User::login($user, $pass);
    
    if ($result) {
        $userobj = new User($user);
        echo "Login Success ", $userobj->getUsername();
        $token = usersession::authenticate($user, $pass);
        if ($token) {
            Session::set('session_token', $token);
            Session::set('is_loggedin', true);
            Session::set('session_username', $result);
        }
    } else {
        echo "Login failed, $user <br>";
    }
}

echo <<<EOL
<br><br><a href="logintest.php?logout">Logout</a>
EOL;

