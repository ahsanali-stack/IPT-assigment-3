<?php


class DB_CONNECT
{

    public function __construct()
    {
    }
    public function connect()
    {
        
        //echo DB_CONNECT::$dbname;
        // Create connection
        $conn = new mysqli('localhost', 'test_app', '2323~;QXRM','test');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        return $conn;

    }
}

