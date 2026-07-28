<?php
$base = __DIR__ . '/includes/';
include_once $base . 'session.class.php';
include_once $base . 'User.class.php';
include_once $base . 'Database.class.php';
include_once $base . 'usersession.class.php';
include_once $base . 'webAPI.class.php';

global $__site_config;
/*
Note: Location of configuration
in lab : /home/user/phtogramconfig.json
in server: /var/www/photogramconfig.json
*/


$wapi = new WebAPI();
$wapi->initiateSession();

function get_config($key, $default=null)
{
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

//Resume from here.
function load_template($name)
{
    $template_path = __DIR__ . '/../_template/' . $name . '.php';
    if (file_exists($template_path)) {
        include $template_path;
    } else {
        $fallback = __DIR__ . '/_template/' . $name . '.php';
        if (file_exists($fallback)) include $fallback;
    }
}

function validate_credentials($username, $password)
{
    if ($username == "sibi@selfmade.ninja" and $password == "password") {
        return true;
    } else {
        return false;
    }
}
