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
        if ($this->connection->connect_error) {
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
        $result = $stmt->execute();
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

        $this->findOrFail(10);

    }

    public function delete()
    {

    }

    public function save()
    {
        $this->connection = $this->openConn();
        $table = $this->table;

        $id = $this->column['id']['value'];

        if (!$this->findOrFail($id)) {
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
        $sql = "SELECT id FROM " . $this->table . " WHERE " . $this->column['id'] . " = " . $id;
        $stmt = $connection->prepare($sql);
        echo $this->validate();
//        print_r($stmt->execute());

    }

    private function newRow()
    {

    }


    /**
     * Validate the given data.
     * @return bool|string
     */
    protected function validate()
    {
        //TODO: Return array with all required/type errors. So we can show feedback on input fields (Red borders/ Validation text underneath);

        //Step 1: Get the columns for the class.
        $this->getColumns();

        //Step 2: Loop over the columns.
        foreach ($this->column as $key => $value) {
            //Get the value for the given key. (Example : $Product->getStockItemID())
            $keyValue = $this->{"get" . $key}();

            //Check if the column is required && Check if the keyValue is filled.
            if ($value[2] === "Required" && empty($keyValue)) {
                return $key . " is required, but it's empty.";
            } //Validate the type(int, string) of the value.
            else if (!$this->validateType($value[1], gettype($keyValue))) {
                return $key . " Should be of type " . $value[1] . " but type " . gettype($keyValue) . " was given.";
            }
        }
        return true;
    }

    /**
     * Validate the type(int, string) of the column.
     * @param $type
     * @param $setType
     * @return bool
     */
    private function validateType($type, $setType)
    {
        //We cant compare $setType if no value is given.
        switch ($type) {
            case "PrimaryKey":
            case "HasOne":
            case "HasMany":
            case "Integer":
                if (!$setType == "integer") {
                    return false;
                }
                break;
            case "Varchar":
            case "LongText":
                if (!$setType === 'string') {
                    return false;
                }
                break;
            default:
                break;
        }
        return true;
    }


}