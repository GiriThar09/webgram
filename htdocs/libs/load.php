<?php
include_once __DIR__ . '/includes/session.class.php';
include_once __DIR__ . '/includes/Mic.class.php';
include_once __DIR__ . '/includes/User.class.php';
include_once __DIR__ . '/includes/Database.class.php';
include_once __DIR__ . '/includes/usersession.class.php';
include_once __DIR__ . '/includes/WebAPI.class.php';

global $__site_config;
$__site_config = '';
$__config_candidates = [
    __DIR__ . '/../../../project/database_keys.json',
    __DIR__ . '/../../project/database_keys.json',
    __DIR__ . '/../../database_keys.json',
    __DIR__ . '/../../../database_keys.json',
    '/home/girithargirithar089/database_keys.json',
    '/var/www/database_keys.json',
    '/var/www/html/database_keys.json',
];

foreach ($__config_candidates as $candidate) {
    if (is_file($candidate)) {
        $__site_config = file_get_contents($candidate);
        break;
    }
}

if (!function_exists('session_start')) {
    function session_start() {}
}

Session::start();

$wapi = new WebAPI();
$wapi->initiateSession();

function get_config($key, $default=null)
{
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (!is_array($array)) {
        return $default;
    }
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

function load_template($name)
{
    $template_name = ltrim($name, '/');
    $template_path = __DIR__ . '/../_template/' . $template_name;

    if (!file_exists($template_path)) {
        $template_path = __DIR__ . '/_template/' . $template_name;
    }

    if (file_exists($template_path)) {
        include $template_path;
        return;
    }

    $legacy_path = $_SERVER['DOCUMENT_ROOT'] . get_config('base_path', '') . '_template/' . $template_name;
    if (file_exists($legacy_path)) {
        include $legacy_path;
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
