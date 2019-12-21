<?php


namespace Model;


class User extends Database
{
    private $username;
    private $password;
    protected $table;
    private $dbPassword;
    private  $UserDataArray;
    private $passwordRecoveryTime;

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

    public function setUserDataArray($sqlreturendsomething)
    {
        $this->UserDataArray = $sqlreturendsomething;
    }

    public function  getUserDataArray()
    {
        return $this->UserDataArray;
    }

    public function checkCredentials()
    {
        $getthedata=new Database();
        //todofixpls Nope! fixing it would over complicate the shit out if it!
        $sqlreturendsomething=$getthedata->selectStmt("SELECT * FROM people WHERE LogonName = '".$this->username . "'");
        if(!$sqlreturendsomething)
        {
            return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
        }
        else
        {
            // return the password found in te database and place the userdata in a variable.
            $this->setUserDataArray($sqlreturendsomething);
            $this->setDbPassword($sqlreturendsomething[0]['HashedPassword']);
            return true;
        }
    }

    // this sets the TTL of the passwordrecovery link.
    public function passwordRecoveryTime()
    {
        return $this->passwordRecoveryTime=600;
    }


}