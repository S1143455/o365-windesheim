<?php

namespace Model;

use http\Exception\InvalidArgumentException;
use PDO;

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
    }

    /**
     * Opens a connection to the database.
     * @return false|PDO
     */
    private function openConn()
    {
        /** @noinspection PhpComposerExtensionStubsInspection */
        if ($this->connection == null) {
            $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (false) {
                echo "connection could not be established";
                die('Connection refused');
            }
        }
    }

    /**
     *  Temporary function
     * Executes a SELECT statement.
     * @param $sql
     * @return $result
     */
    public function selectStmt($sql)
    {
        if ($this->connection == null) {
            $this->openConn();
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $this->closeConnection();
        return $stmt->fetchAll();
    }

    /**
     * Temporary function
     * Executes a UPDATE statement.
     * @param $sql
     * @return $result
     */
    public function UpdateStmt($sql)
    {
        if ($this->connection == null) {
            $this->openConn();
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $this->closeConnection();
        return $stmt->rowcount();
    }

    /**
     * Temporary function
     * @param $sql
     * @return mixed
     */
    public function selectFetchAll($sql)
    {
        if ($this->connection == null) {
            $this->openConn();
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $this->closeConnection();
        return $stmt->fetch_all();
    }

    private function closeConnection()
    {
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

    public function delete($id)
    {

    }
    public function save()
    {
        $this->connection = $this->openConn();
        $table = $this->table;
        $this->getColumns();
        $this->validate();


        //var_dump($this->getID("value"));
        if ($this->checkIfExists($this->getID("value")) == null) {
            return $this->newRow();
        } else if ($this->getID("value") != null) {


                return $this->UpdateEntry();

        }
    }


    /**
     * Finds a single row from the database by id.
     * @param $id
     * @return mixed|null
     */
    private function find($id)
    {
        $retVal = $this;
        if ($id != null) {
            $this->openConn();
            $key = $this->getID("key");

            $retrieved = $this->where("*", $key, "=", $id);
            return $retrieved[0];

        }

    }

    /**
     * Checks if the entry by given id exists in the database.
     * @param $id
     * @return mixed|null
     */
    private function checkIfExists($id)
    {
        $retVal = null;
        if ($id == null) {
            return false;
        }
        $this->openConn();
        $key = $this->getID("key");
        $retrieved = $this->where($key, $key, "=", $id);
        if (!empty($retrieved)) {
            return true;
        }
        return false;
    }

    /**
     * Creates a database select statement
     * (SELECT * FROM TABLE)
     * @param $selectType
     * @param $returnAttr
     * @return string
     */
    private function createSelectStatement($returnAttr)
    {
        $attributes = "";
        if (is_array($returnAttr)) {
            foreach ($returnAttr as $key => $value) {
                $attributes .= $value . (end($returnAttr) == $value ? "" : ", ");
            }
        } else {
            $attributes = $returnAttr;
        }

        return "SELECT " . $attributes . " FROM `" . $this->table . "` ";
    }


    private function createUpdateStatement()
    {
        $values = [];
        $placeholder = "";
        $primarykey = "";
        foreach ($this->column as $key => $value) {
            foreach ($value as $attribuut) {
                if ($attribuut == "PrimaryKey") {
                    $primarykey = $key;
                }
            }
            $placeholder .= ' ' . $key . ' = \'' . $this->getAttribute($key) . '\',';
        }

        //$columns = substr($columns, 0, -2);
        $placeholder = substr($placeholder, 0, -1);

        $sql = "UPDATE " . $this->table . " set " . $placeholder . " where " . $primarykey . " = " . $this->getAttribute($primarykey) . " ;";
        $stmt = $this->connection->prepare($sql);
        foreach ($values as $parameter => $value) {
            $stmt->bindValue($parameter, $value);
        }
        return $stmt;
    }

    /**
     *
     * Creates a sql query.
     *
     * @param $returnAttr (Eg. Select);
     * @param $columnKeys (Eg. "StockItemID" or ["StockItemID", "StockItemName"]);
     * @param $compareTypes (Eg. "=" or ["=", ">"])
     * @param $values (Eg. 10 or [10, 'TheNameForTheStockItem'])
     * @return array
     */
    public function where($returnAttr, $columnKeys, $compareTypes, $values)
    {
        $type = $this->checkQueryParameters($columnKeys, $compareTypes, $values);

        $sql = $this->createSelectStatement($returnAttr);
        $where = "";

        //Single search.
        if ($type == "single") {

            $where = $columnKeys . " " . $compareTypes . " :" . $columnKeys;
            $sql .= " WHERE " . $where;
            $columnKeys = [$columnKeys];
            $values = [$values];
        } //multiple search points
        else {
            for ($i = 0; $i < sizeof($columnKeys); $i++) {
                $where .= $columnKeys[$i] . " " . (is_array($compareTypes) ? $compareTypes[$i] : $compareTypes) . " :" . $columnKeys[$i];
                if (($i + 1) < sizeof($columnKeys)) {
                    $where .= " && ";
                }
            }
            $sql .= " WHERE " . $where;
        }

        $this->openConn();
        $stmt = $this->connection->prepare($sql);
//        var_dump($values);
        for ($i = 0; $i < sizeof($columnKeys); $i++) {
            $stmt->bindValue(":" . $columnKeys[$i], $values[$i]);
        }
        $stmt->execute();

        $retVal = $stmt->fetchAll();
        $this->connection = null;
        $retVal = $this->initRetrievedObjects($retVal);

        //Remove or comment these lines --
        //echo "Query that was created and executed :<br>" . $sql;
        //echo "<br> The array of objects that has been found: <br>";
        //print_r($retVal);
        // -- End

        return $retVal;
    }

    /**
     * Retrieves entries from the database, if $id is not filled it will return the first 10 entries.
     * @param null $id
     */
    public function retrieve($id = null)
    {
        $this->getColumns();

        if ($id == null)
        {
            return $this->batch(null, $this->offset);
        } else {
            return $this->find($id);
        }

    }

    /**
     * @param $columnKeys
     * @param $compareTypes
     * @param $values
     * @return string
     */
    private function checkQueryParameters($columnKeys, $compareTypes, $values)
    {
        $checkInput = [is_array($columnKeys), is_array($compareTypes), is_array($values)];
        if ($checkInput[0] && $checkInput[1] && $checkInput[2]) {
            $validArrayLength = (sizeof($columnKeys) + sizeof($compareTypes) + sizeof($values)) / 3;
            if ($validArrayLength != 3) {
                die("Parameters differ in size");
            }
            return "array";
        } else if ($checkInput[0] && $checkInput[2]) {



            $validArrayLength = (sizeof($columnKeys) + sizeof($values)) / 3;

            $validArrayLength = (sizeof($columnKeys) + sizeof($values)) / 2;
            echo sizeof($columnKeys);
            echo sizeof($values);

            $validArrayLength = (sizeof($columnKeys) + sizeof($values)) / 2;
            echo sizeof($columnKeys);
            echo sizeof($values);

            if ($validArrayLength != 2) {
                die("Parameters differ in size");
            }
            return "array";
        } else if (!$checkInput[0] && !$checkInput[1] && !$checkInput[2]) {
            return "single";
        } else {
//            var_dump($columnKeys);
//            var_dump( $compareTypes);
//            var_dump($values);

            die('All parameters should be of the same type.');
        }
    }

    /**
     * Gets the next batch of items.
     */
    protected function nextBatch()
    {

    }

    /**
     * Retrieves entries from the database.
     * @param $limit
     * @param $offset
     */
    private function batch($limit, $offset)
    {
        $this->openConn();
        $this->getColumns();
        $sql = $this->createSelectStatement("*");
        $sql .= ($limit != null ? " LIMIT " . $limit : "") . ($offset !== null && $offset > 0 ? " OFFSET " . $offset : "");

        $stmt = $this->connection->query($sql);
        $stmt->execute();
        try {
            $retVal = $stmt->fetchAll();
            if (empty($retVal)) {
                $retVal = [];
            } else {
                $retVal = $this->initRetrievedObjects($retVal);
            }
        } catch (Exception $e) {
            die($e);
            $retVal = null;
        }
        $this->closeConnection();
        return $retVal;
    }

    private function UpdateEntry()

    {
        $this->openConn();
        $stmt = $this->createUpdateStatement();
//       var_dump($this->table);
        try
        {
            $stmt->execute();
        } catch (Exception $e)
        {
//            $_GET['error'] = $e->getMessage();
            return false;
        }
        return true;
    }
    /**
     * Creates a new database row.
     */
    private function newRow()
    {
        $this->openConn();
        $stmt = $this->createInsertStatement();
        try
        {
            $stmt->execute();
            $lastInsertID = $this->connection->lastInsertId();
            $primaryKey = $this->getID("key");

            $this->setAttribute($primaryKey,$lastInsertID);
        } catch (Exception $e)
        {
            return false;
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
     * @param $value
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

        $this->getColumns();
        foreach ($this->column as $key => $value)
        {

            $keyValue = $this->getAttribute($key);

            if ($value[2] === "Required" && empty($keyValue))
            {
                return $key . " is required, but it's empty.";
            } else if (!$this->validateType($value[1], gettype($keyValue)))
            {
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
        $this->getColumns();
        foreach ($this->column as $key => $value)
        {
            if ($value[1] == "PrimaryKey")
            {
                if (!$type)
                {
                    return array(
                        "key" => $key,
                        "value" => $this->getAttribute($key)
                    );
                } else if ($type == "key")
                {
                    return $key;
                } else
                {
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
        switch ($type)
        {
            case "PrimaryKey":
            case "HasOne":
            case "HasMany":
            case "Integer":
                if (!$setType == "integer")
                {
                    return false;
                }
                break;
            case "Varchar":
            case "LongText":
                if (!$setType === 'string')
                {
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
        switch ($type)
        {
            case"string":
                return $value;
            case "integer":

                return intval($value);
            case "boolean":
                if ($value || $value == 1 || strtolower($value) == "on")
                {
                    return 1;
                }
                return 0;
            default:
                return strval($value);
        }
    }

    private function getStmtBindType($value)
    {
        $type = gettype($value);
        switch ($type)
        {
            case"string":
                return "s";
            case "integer":
            case "boolean":
                return "i";
            default:
                throw new InvalidArgumentException("Could not convert" . $value . " with type " . gettype($value) . " to a valid type.");
        }
    }

    /**
     * Creates a sql insert statement.
     * @return \PDOStatement
     */
    private function createInsertStatement()
    {
        $columns = "";
        $values = [];
        $placeholder = "";

        foreach ($this->column as $key => $value)
        {

            $attributeValue = $this->getAttribute($key);
            if (!empty($attributeValue) && $value[1])
            {
                $columns .= $key . " , ";
                $placeholder .= ":" . strtolower($key) . ", ";
                $values[strtolower($key)] = $this->serializedInput($attributeValue);
            }
        }
        $columns = substr($columns, 0, -2);
        $placeholder = substr($placeholder, 0, -2);

        $sql = "INSERT INTO " . $this->table . " (" . $columns . ") VALUES (" . $placeholder . ");";

        $stmt = $this->connection->prepare($sql);


        foreach ($values as $parameter => $value)
        {
            // print_r([$parameter, $value]);
            $stmt->bindValue($parameter, $value);
        }
        return $stmt;
    }

    /**
     * Sets all the attributes that are given in the $_POST.
     *
     */


    /**
     * Sets all the attributes that are given in the $_POST.
     *
     */
    public function initialize()
    {
        $this->getColumns();
        $valid = true;
        foreach ($_POST as $key => $value)
        {
            if (!empty($value) && array_key_exists($key, $this->column))
            {
                $type = null;
                switch ($this->getType($key))
                {
                    case "Integer":
                        $type = FILTER_VALIDATE_INT;
                        break;
                    case "Email":
                        $type = FILTER_VALIDATE_EMAIL;
                        break;
                    case "LongText":
                    case "Varchar":
                        $type = FILTER_SANITIZE_SPECIAL_CHARS;
                        break;
                    case "Boolean":
                        $type = FILTER_VALIDATE_BOOLEAN;
                        break;
                    default:
                        $type = FILTER_VALIDATE_INT;

                }

                if (!filter_input(INPUT_POST, $key, $type))
                {

                    $this->setError($this->table, $value);
                }

                if ($type == FILTER_VALIDATE_INT || $type == FILTER_VALIDATE_BOOLEAN)
                {
                    $value = intval($value);
                }

                $this->setAttribute($key, $value);
            }

        }
        return $valid;
    }

    private function initRetrievedObjects($array)
    {
        $modelObjects = [];
        $className = get_class($this);
        $modelObject = new $className;
        $this->getColumns();
      //  var_dump($array);
        if (!empty($array))
        {
            foreach ($array as $key => $value)
            {
                $modelObject = new $className;

                foreach ($value as $attrKey => $attrValue)
                {
                   // var_dump($attrKey);
                    //var_dump($this->column);
                    if (array_key_exists($attrKey, $this->column))
                    {
                        $modelObject->setAttribute($attrKey, $attrValue);
                    }
                }
                array_push($modelObjects, $modelObject);
            }
        } else
        {
            array_push($modelObjects, $modelObject);
        }

        return $modelObjects;
    }

    /**
     * Sets a $_GET header with custom key and value.
     * @param $key
     * @param $value
     */
    private function setError($key, $value)
    {
        if (!isset($_GET[$key]))
        {
            $_GET[$key] = [];
        }
        array_push($_GET[$key], $value);
    }

    /**
     * Get the relation within a model by relationname
     * @param $modelName Name of the model to retrieve
     * @return Mixed null or a single model or multiple models.
     */
    public function getRelation($modelName)
    {
        /**
         * Create the model.
         * @var $model Database;
         */
        $createModelByName = '\Model\\' . $modelName;
        $model = new $createModelByName;
        $model->getColumns();
        if ($model->column == null)
        {
            die('Model does not exist');
        }
        $foreignKey = null;
        $this->getColumns();

        /**
         * Checks if the current model has the modelName as an available attribute,
         * If so it should retrieve a single model.
         *
         */
        foreach ($this->column as $key => $value)
        {
            if ($value[0] == $modelName)
            {
                $foreignKey = $this->getAttribute($key);
                return $model->getModelByID($foreignKey);
            }
        }
        /**
         * Checks if the model that is requested contains the primaryKey attribute of the currentModel,
         * If so it should retrieve multiple models
         */
        $keyToMatch = $this->getID("key");
        foreach ($model->column as $key => $value)
        {
            if ($keyToMatch == $key)
            {
                $models = $model->where("*", $key, "=", $this->getID('value'));
                return $models;
            }
        }

    }

    /**
     * Gets a HasOne relationShip for a model.
     * @param $model The model to fill.
     * @param $foreignKey The primaryKey to find.
     * @return mixed 0 or 1 models retrieved from database
     */
    private function getModelByID($foreignKey)
    {
        foreach ($this->column as $key => $value)
        {
            if ($value[1] == "PrimaryKey")
            {
                $this->setAttribute($key, $foreignKey);
                $model = $this->find($this->getID("value"));
                return $model;
            }
        }
    }

}