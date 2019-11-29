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

    /**
     * Opens a connection to the database.
     * @return false|\mysqli
     */
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
    public function closeConn($connection)
    {
        mysqli_close($connection);
    }

    /**
     * Executes a SELECT statement.
     * @param $sql
     * @return array|null
     */
    public function select($sql)
    {
        $connection = $this->openConn();
        $result = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
        $this->closeConn($connection);
        return $result;
    }
    /**
     * Executes a sql query.
     * @param $sql
     * @return array|null
     */
    //WIP($table , $params = NULL) <- new parameters
    public function create($sql)
    {
//        $keys = array_keys($params);
        $connection = $this->openConn();
        if(mysqli_query($connection,$sql))
        {
            echo "New record created successfully";
        }
        else
            {
                echo "error";
                print_r(mysqli_error($connection));
            }
        $this->closeConn($connection);

    }
    /**
     * Test the database connection.
     * @return false|\mysqli
     */
    public function testConn()
    {
        return;
    }





}