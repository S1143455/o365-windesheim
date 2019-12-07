<?php


namespace Model;


class User extends Database
{
    private $username;
    private $password;
    protected $table;
    private $dbPassword;

    function __construct()
    {
        Parent::__construct();
        $this->table = 'People';
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param $dbPassword
     */
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;
    }

    public function getDbPassword()
    {
        return $this->dbPassword;
    }

    public function checkCredentials()
    {
        $getthedata=new Database();
        $sqlreturendsomething=$getthedata->select("SELECT * FROM people WHERE LogonName = '".$this->username . "'");
        if(!$sqlreturendsomething)
        {
            $_SESSION['LOGIN_ERROR']='Gebruikersnaam of wachtwoord onjuist.';
            return false;
        }
        else
        {
            // return the password found in te database.
            $this->setDbPassword($sqlreturendsomething[0][3]);
            return true;
        }
    }




}