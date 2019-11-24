<?php

namespace Classes;
class Database
{
    private $database;
    private $hostname;
    private $username;
    private $password;

    function __construct()
    {
        $this->hostname = getenv('DATABASEHOSTNAME');
        $this->database = getenv('DATABASE');
        $this->username = getenv('DATABASEUSERNAME');
        $this->password = getenv('DATABASEPASSWORD');
        $this->testConn();
    }

    public function openConn()
    {
        $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if (!$connection) {
            die ("Unable to connect to MySQL: " . mysqli_error($connection));
        }
        return $connection;
    }


    private function testConn()
    {
        return $this->openConn();
    }
}