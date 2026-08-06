<?php

class WebAPI
{
    public function __construct()
    {
        global $__site_config;
        $__site_config = '';
        $__site_config_path = __DIR__ . '/../../../project/database_keys.json';
        if (is_file($__site_config_path)) {
            $__site_config = file_get_contents($__site_config_path);
        } else {
            $__site_config_path = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']).'/database_keys.json';
            if (is_file($__site_config_path)) {
                $__site_config = file_get_contents($__site_config_path);
            }
        }

        Database::getConnection();
    }

    public function initiateSession()
    {
        //Session::start();
        
        // $__base_path = get_config('base_path');
    }
}

