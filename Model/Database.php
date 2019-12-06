<?php

namespace Model;

use mysqli;

//TODO: Look into static functions for global database functions.

class Database extends Models
{
    private $database;
    private $hostname;
    private $username;
    private $password;
    private $connection;
    protected $table;
    protected $limit = 10;
    protected $offset = 0;


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
    private function openConn()
    {
        /** @noinspection PhpComposerExtensionStubsInspection */
        if ($this->connection == null) {
            $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
            if ($this->connection->connect_error) {
                echo "connection could not be established";
                die('Connection refused');
            }
        }
    }

    /**
     * Executes a SELECT statement.
     * @param $sql
     * @return $result
     */
    public function selectStmt($sql)
    {
        if ($this->connection == null) {
            $this->openConn();
        }
        $stmt = $this->connection->query($sql);
        $this->closeConnection();

        return $stmt;
    }

    public function selectFetchAll($sql)
    {
        if ($this->connection == null) {
            $this->openConn();
        }
        $stmt = $this->connection->query($sql);
        $this->closeConnection();

        return $stmt->fetch_all();
    }

    private function closeConnection()
    {
        $this->connection->close();
        $this->connection = null;
    }
    /**
     * Executes a sql query.
     * @param $sql
     * @return array|null
     */
    //WIP($table , $params = NULL) <- new parameters
    public function create($sql)
    {

        $this->checkIfExists(10);

    }

    public function delete()
    {

    }

    public function save()
    {
        $this->connection = $this->openConn();
        $table = $this->table;

        $this->getColumns();
        $this->validate();
        if ($this->checkIfExists($this->getID("value")) == null) {
            return $this->newRow();
        }

    }

    /**
     * Finds a single row from the database by id.
     * @param $id
     * @return mixed|null
     */
    public function find($id)
    {
        $retVal = null;
        if ($id != null) {
            $this->openConn();
            $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->getID("key") . " = " . $id;
            $stmt = $this->connection->query($sql);

            if (!array_key_exists('error', $this->connection) && $stmt->num_rows > 0) {
                $retVal = $stmt->fetch_row();

            }
            $this->closeConnection();
        }
        return $retVal;
    }

    public function checkIfExists($id)
    {
        $retVal = null;
        if ($id != null) {
            $this->openConn();
            $sql = "SELECT " . $this->getID('key') . " FROM " . $this->table . " WHERE " . $this->getID("key") . " = " . $id;
            $stmt = $this->connection->query($sql);

            if (!array_key_exists('error', $this->connection) && $stmt->num_rows > 0) {
                $retVal = $stmt->fetch_row();
            }
            $this->closeConnection();
        }
        return $retVal;
    }

    public function retrieve($id = null)
    {
        //TODO : Pagination to retrieve x amount; // Find a way to make the $limit $offset . Global variables.
        $this->getColumns();
        if (empty($id)) {
            $this->batch($this->limit, $this->offset);
        }
        $this->find($id);

    }

    /**
     * Gets the next batch of items.
     */
    protected function nextBatch()
    {

    }

    private function batch($limit, $offset)
    {
        $this->openConn();
        $this->getColumns();
        $sql = "SELECT * FROM " . $this->table . ($limit !== null ? " LIMIT " . $limit : "") . ($offset !== null ? " OFFSET " . $offset : "");
        echo $sql;

    }

    /**
     * Creates a new database row.
     */
    private function newRow()
    {
        $this->openConn();
        $sql = $this->createInsertStatement();
        $this->connection->query($sql);
//        print_r($this->connection);
        if ($this->connection->error) {
            print_r($this->connection->error);
            return $this->connection->error;
        }
        return true;
    }

    /**
     * Sets the attribute
     * @param $key
     * @return mixed
     */
    private function getAttribute($key)
    {
        return $this->{"get" . $key}();
    }

    /**
     * Sets the attribute
     * @param $key
     * @return mixed
     */
    private function setAttribute($key, $value)
    {
        return $this->{"set" . $key}($value);
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
            $keyValue = $this->getAttribute($key);

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
     * Get the ID key, value or both for the primarykey
     * @param null $type
     * @return array|int|mixed|string|null
     */
    private function getID($type = null)
    {
        foreach ($this->column as $key => $value) {
            if ($value[1] == "PrimaryKey") {
                if (!$type) {
                    return array(
                        "key" => $key,
                        "value" => $this->getAttribute($key)
                    );
                } else if ($type == "key") {
                    return $key;
                } else {
                    return $this->getAttribute($key);
                }
            }
        }
        return null;
    }

    /**
     * Validate the type(int, string) of the column.
     * @param $type
     * @param $setType
     * @return bool
     */
    private function validateType($type, $setType)
    {
        //TODO : DATETIME TESTER
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

    /**
     * Returns the correct input for use in a SQL statement
     * @param $value
     * @return string
     */
    private function serializedInput($value)
    {

        $type = gettype($value);
        switch ($type) {
            case"string":
                return "'" . $value . "'";
            case "integer":
                return $value;
            case "boolean":
                if ($value) {
                    return 1;
                }
                return 0;
            default:
                return strval($value);
        }
    }

    /**
     * Creates a sql insert statement.
     * @return string
     */
    private function createInsertStatement()
    {
        $columns = "";
        $values = "";
        foreach ($this->column as $key => $value) {
            $attributeValue = $this->getAttribute($key);
            if (!empty($attributeValue)) {
                $columns .= $key . " , ";
                $values .= $this->serializedInput($attributeValue) . ",";
            }
        }
        $columns = substr($columns, 0, -2);
        $values = substr($values, 0, -1);

        $sql = "INSERT INTO " . $this->table . " (" . $columns . ") VALUES (" . $values . ");";
        print_r($sql);
        return $sql;
    }

    /**
     * Sets all the attributes that are given in the $_POST.
     *
     */
    public function initialize()
    {
        $this->getColumns();

        foreach ($_POST as $key => $value) {
            if (!empty($value) && array_key_exists($key, $this->column)) {
                $type = null;
                switch ($this->getType($key)) {
                    case "Integer":
                        $type = FILTER_VALIDATE_INT;
                        break;
                    case "Email":
                        $type = FILTER_VALIDATE_EMAIL;
                        break;
                    case "String":
                        $type = FILTER_SANITIZE_SPECIAL_CHARS;
                        break;
                    case "Boolean":
                        $type = FILTER_VALIDATE_BOOLEAN;

                }
                $value = filter_input(INPUT_POST, $key, $type);

                print_r([$type, $value]);
                $this->setAttribute($key, $value);
            }
        }
    }
}