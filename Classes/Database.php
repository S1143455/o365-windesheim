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
    }

    public function openConn()
    {
        $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if (!$connection) {
            die ("Unable to connect to MySQL: " . mysqli_error($connection));
        }
        return $connection;
    }


    /**
     * Closes the connection to the database.
     * @param $connection
     */
    public function CloseCon($connection)
    {
        mysqli_close($connection);
    }

    /**
     * Executes a SELECT statement.
     * @param $sql
     * @return array|null
     */
    public function Select($sql)
    {
        $connection = $this->OpenCon();
        $result = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
        $this->CloseCon($connection);
        return $result;
    }
    public function create($sql)
    {


        $connection = $this->openConn();

    }



}