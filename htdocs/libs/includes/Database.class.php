<?php
// Note: don't require load.php here to avoid circular includes (load.php already includes this file)
// require_once __DIR__ . '/../load.php';
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
            // Support host:port form in db_server
            $host = $servername;
            $port = null;
            if (strpos($servername, ':') !== false) {
                list($host, $port) = explode(':', $servername, 2);
                $port = intval($port);
            }
            // Create connection (pass port if available) with exception handling
            try {
                if ($port) {
                    $connection = new mysqli($host, $username, $password, $dbname, $port);
                } else {
                    $connection = new mysqli($host, $username, $password, $dbname);
                }
                if ($connection->connect_error) {
                    throw new mysqli_sql_exception($connection->connect_error);
                }

                // printf("connection successfull");
                Database::$conn = $connection;
                return Database::$conn;
            } catch (mysqli_sql_exception $e) {
                $logmsg = sprintf("Database connection failed to %s%s: %s", $host, $port ? ':' . $port : '', $e->getMessage());
                error_log($logmsg);
                // Re-throw so existing error behavior continues and logs show stack trace
                throw $e;
            }
        }
        else
        {
            printf("connection already exists");
            return Database::$conn;
        }
    }
}

