<?php
/*
 *  Developed by : Priyanka Khadilkar
    This file is being used for the connection to the database,
    and database configuration
*/
class Database
{

    private static $user = 'FqVeyaw77x';
    private static $password = 'WvRmXDH8lP';
    private static $dsn = 'mysql:host=remotemysql.com;dbname=FqVeyaw77x;port=3306';
    private static $dbcon;

    public function __construct()
    {

    }

    //Connect to database
    public static function getDb()
    {
        if (!isset(self::$dbcon)) {
            try {
                self::$dbcon = new \PDO(self::$dsn, self::$user, self::$password);
            } catch (PDOException $e) {
                $msg = $e->getMessage();
                echo $msg;
                exit();
            }
        }
        return self::$dbcon;
    }

}


