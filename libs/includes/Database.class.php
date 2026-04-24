<?php
require_once __DIR__ . '/../load.php';
class Database
{
    public static $conn = null;   
    public static function getconnection()
    {
        if(Database::$conn == null)
        {
            $servername = get_config("db_server");
            $username = get_config("db_username");
            $password = get_config("db_password");
            $dbname = get_config("db_name");
            // Create connection
            $connection = new mysqli($servername,$username,$password,$dbname);
            if($connection->connect_error)
            {
                die("connection failed!".$connection->connect_error);
            }
            else
            {
                // printf("connection successfull");
                Database::$conn = $connection;
                return Database::$conn;
            }
        }
        else
        {
            printf("connection already exists");
            return Database::$conn;
        }
    }
}

