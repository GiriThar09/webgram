<?php

class WebAPI
{
    public function __construct()
    {
        // if (php_sapi_name() == "cli") {
        //     global $__site_config;
        //     $__site_config_path = "/home/sibidharan/htdocs/photogram/project/photogramconfig.json";
        //     $__site_config = file_get_contents($__site_config_path);
        // //print($__site_config);
        // } elseif (php_sapi_name() == "apache2handler") {
        //     global $__site_config;
        //     $__site_config_path = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']).'/project/photogramconfig.json';
        //     $__site_config = file_get_contents($__site_config_path);
        // }
        // print(__DIR__);
        global $__site_config;
        $__site_config_path = __DIR__ . '/../../../../photogram/data/photogramconfig.json';
        if (file_exists($__site_config_path)) {
            $__site_config = file_get_contents($__site_config_path);
        } else {
            // fallback: try a project path inside app (older layouts)
            $alt = __DIR__ . '/../../../project/photogramconfig.json';
            if (file_exists($alt)) {
                $__site_config = file_get_contents($alt);
            } else {
                $__site_config = '{}';
            }
        }
        Database::getConnection();
    }

    public function initiateSession()
    {
        Session::start();
        
        // $__base_path = get_config('base_path');
    }
}
