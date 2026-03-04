<?php
class Database
{
    public static $conn = null;   
    public static function getconnection()
    {
        if(Database::$conn == null)
        {
            $servername = "mysql.selfmade.ninja:3306";
            $username = "girithar_ff_";
            $password = "sri9629185073";
            $dbname = "girithar_ff__webgram";
            // Create connection
            $connection = new mysqli($servername,$username,$password,$dbname);
            if($connection->connect_error)
            {
                die("connection failed!".$connection->connect_error);
            }
            else
            {
                printf("connection successfull");
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

