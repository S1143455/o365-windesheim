<?php


namespace Model;


class User extends Database
{
    private $username;
    private $password;
    protected $table;
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

    public function checkCredentials()
    {
<<<<<<< HEAD
        $getthedata=new Database();
        $sqlreturendsomething=$getthedata->select("SELECT * FROM people WHERE LogonName = '".$this->username. "'");
        print_r($sqlreturendsomething);
        if(!$sqlreturendsomething)
        {
            $_SESSION['LOGIN_ERROR']='Gebruikersnaam of wachtwoord onjuist.';
            return;
        }
=======
        'SELECT * FROM people WHERE username = ? or email = ? ';
        if($sqlreturendsomething)
            $this->setPassword($retrieved->password);

        return true;
>>>>>>> 176adc9769a05f7262d4d6cf760caeaaa6f35f92
    }

}