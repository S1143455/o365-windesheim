<?php

namespace Controller;
use Model\Customer;
use Model\Database;
use Model\User;
use Model\Adress;

class UserController
{
    function __construct()
    {
        $this->user = new User();
        $this->customer = new Customer();
        $this->addres = new Adress();
    }
    public function getCustomerByID($id){
        $this->customer = $this->customer->retrieve($id);
        return $this->customer;
    }
    public function getAdressByID($id){
        $this->addres = $this->addres->retrieve($id);
        return $this->addres;
    }

    public function getUsername()
    {
        if (isset($_SESSION['USER']))
        {
            return $_SESSION['USER']['LogonName'];
        }
        return 'Login';
    }
    public function isAdmin()
    {
        return true;
    }
    public function retrievebylogin($return, $key, $id){
        $user = $this->user->databaseWhere($return,$key,$id);
        return $user;
    }
    public function GetEmailByName($return, $key, $id){
        $user = $this->user->databaseWhere($return,$key,$id);
        var_dump($user);
        return true;
    }


    /**
     * Stores the product in the database.
     *
     * @param $user User
     * @return string
     */
    public function store($user)
    {
        if (!$user->initialize())
        {
            return false;
        };
        $this->user = $user;

        if (!$this->user->save())
        {
            return "Something went wrong.";
        }
    }

    /**
     * Stores the product in the database.
     *
     * @param $user1 User
     * @return string
     */
    public function update($user1)
    {
        $this->store($user1);

    }
    /**
     * Login for the user.
     * @param $username
     * @param $password
     * @return array
     */
    function login($username, $password)
    {
        if($username == '' || $password  == '')
        {
            return $_SESSION['LOGIN_ERROR']=["type"=>'warning', "message"=>'Vul een gebruikersnaam en wachtwoord in.'];
        }

        //$this->user->setLogonName($username);
        //$this->user->setHashedPassword($password);
        if($this->checkCredentials($username, $password))
        {
            // Check if the passwords match.
            if ($this->verifyPassword($password,$this->user->getHashedPassword()))
            {
                $_SESSION['authenticated']='true';
                $_SESSION['USER']= $this->user;
                $_SESSION['USER']['PersonID']= $this->user->getPersonID();
                $_SESSION['USER']['LogonName']= $this->user->getLogonName();
                $_SESSION['USER']['IsSystemUser']= $this->user->getIsSystemUser();
                $_SESSION['USER']['Role']= $this->user->getRole();
                $_SESSION['USER']['EmailAddress']= $this->user->getEmailAddress();
                $_SESSION['USER']['Fullname']= $this->user->getFullname();
                $customerDetails = $this->getCustomerByID($_SESSION['USER']['PersonID']);
                $_SESSION['USER']['CUSTOMER_DETAILS']=$customerDetails;
                $addressDetails = $this->getAdressByID($_SESSION['USER']['PersonID']);
                $_SESSION['USER']['ADDRESS']=$addressDetails;

                $_SESSION['LOGIN_ERROR']=['type'=>'success', 'message'=>'U bent ingelogd'];
                echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
            }
            else
            {
                $this->unsetData();
                return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
            }
        }

    }
    public function unsetData(){
        unset($_SESSION['authenticated']);
        unset($_SESSION['USER']);
        unset($_SESSION['USER']['PersonID']);
        unset($_SESSION['USER']['LogonName']);
        unset($_SESSION['USER']['IsSystemUser']);
        unset($_SESSION['USER']['Role']);
        unset($_SESSION['USER']['EmailAddress']);
        unset($_SESSION['USER']['Fullname']);
        unset($_SESSION['USER']['CUSTOMER_DETAILS']);
        unset($_SESSION['USER']['ADDRESS']);

        $this->user = new user();
    }
    /**
     * Hash the users password on registration.
     * @param $password
     * @return bool|string
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verifies the user password.
     * @param $inputPassword
     * @param $dbPassword
     * @return bool
     */
    private function verifyPassword($inputPassword, $dbPassword)
    {
        echo $dbPassword;
        return password_verify($inputPassword, $dbPassword);
    }

    /**
     * Registers the user.
     * @param $data
     */
    function register($data)
    {

    }
    function logout()
    {
        if (isset($_SESSION['authenticated'])) {
            unset($_SESSION['authenticated']);
            unset($_SESSION['USER']);
        }
    }

    function isAuthenticated()
    {

        if (isset($_SESSION['authenticated'])) {
            return "Welkom, " . $this->user->getLogonName();
        } else {
            return " | <a class='pull-right' href='/login'>Login</a> | <a class='pull-right' href='/register'>Register</a>";
        }
    }

    function role(){
        return 'role';
    }

    public function checkCredentials($logonName,$password)
    {
        $user = $this->user->where("*", "LogonName", "=", $logonName);
        if(!$user)
        {
            return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
        }
        else
        {
            $this->user = $user;
            return true;
        }
    }

    public function passwordRecoveryTime()
    {
        return $this->passwordRecoveryTime=600;
    }
    public function databaseWhere($return, $key, $id){
        $retrieved = $this->where($return, $key, "=", $id);
        return $retrieved;
    }

}

