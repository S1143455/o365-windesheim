<?php

namespace Model;
use mysqli;

class Database extends Models
{
    private $database;
    private $hostname;
    private $username;
    private $password;
    private $connection;
    protected $table;
    protected $column;
    function __construct()
    {
        $this->hostname = getenv('DATABASEHOSTNAME');
        $this->database = getenv('DATABASE');
        $this->username = getenv('DATABASEUSERNAME');
        $this->password = getenv('DATABASEPASSWORD');
        $this->connection = $this->openConn();
    }

    /**
     * Opens a connection to the database.
     * @return false|mysqli
     */
    public function openConn()
    {
        /** @noinspection PhpComposerExtensionStubsInspection */
        $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error)
        {
            die('Connection refused');

        }
        return $this->connection;
    }

    /**
     * Executes a SELECT statement.
     * @param $sql
     * @return $result
     */
    public function select($sql)
    {

        $stmt = $this->connection->prepare($sql);
        $result  = $stmt->execute();
        $this->connection->close();

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

        $id = $this->column['id'];

        $this->findOrFail($id);

    }

    public function delete()
    {

    }
    public function save()
    {
        $this->connection = $this->openConn();
        $table = $this->table;

        $id = $this->column['id']['value'];
        
        if(!$this->findOrFail($id))
        {
            $this->newRow();
            return;
        }

    }
    public function find($id)
    {

    }
    public function findOrFail($id)
    {
        $connection = $this->connection;
        $sql = "SELECT id FROM " . $this->table . " WHERE ".  $this->column['id'] . " = " . $id ;
        $stmt = $connection->prepare($sql);
        print_r($stmt->execute());

    }
    private function newRow()
    {

    }
    protected function validate()
    {

    }







}