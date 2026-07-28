<pre>
<?php
// setcookie("testcookie", "testvalue", time() + (86400 * 30), "/");
include 'load.php';

print("_SESSION \n");
print_r($_SESSION);
print("_SERVER \n");
print_r($_SERVER);

if (isset($_GET['clear'])) {
    printf("Clearing...\n");
    Session::unset();
}

if (Session::isset('a')) {
    printf("A already exists... Value: ".Session::get('a')."\n");
} else {
    Session::set('a', time());
    printf("Assigning new value... Value: $_SESSION[a]\n");
}

if (isset($_GET['destroy'])) {
    printf("Destroying...\n");
    Session::destroy();
}




?></pre>
