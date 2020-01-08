<?php

namespace Controller;
use Model\Database;
use Model\User;

class AuthenticationController
{
    function __construct()
    {
        $this->user = new User();
    }

    public function getdata()
    {
        $getthedata=new Database();
        $sqlreturendsomething=$getthedata->selectStmt("SELECT * FROM people WHERE LogonName = '". $this->user->getLogonName()  . "'");

            return $sqlreturendsomething;

    }

    public function getCustomerDetails()
    {
        $getthedata=new Database();
        $customerDetails=$getthedata->selectStmt("SELECT * FROM customer WHERE PersonID = '". $_SESSION['USER']['DATA'][0]['PersonID'] . "'");
        return $customerDetails;
    }

    public function getAddressDetails()
    {
        $getthedata=new Database();
        $addressDetails=$getthedata->selectStmt("SELECT * FROM address WHERE PersonID = '". $_SESSION['USER']['DATA'][0]['PersonID'] . "'");
        return $addressDetails;
    }


    public function checkCredentials($logonName,$password)
    {
        $user = $this->user->where("*", "LogonName", "=", $logonName);
        if(empty($user))
        {
            return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
        }
        else
        {
            $this->user = $user[0];
            return true;
        }
    }
    /**
     * Login for the user.
     * @param $username
     * @param $password
     * @return string
     */
    function login($username, $password)
    {
        if($username == '' || $password  == '')
        {
            return $_SESSION['LOGIN_ERROR']=["type"=>'warning', "message"=>'Vul een gebruikersnaam en wachtwoord in.'];
        }


        if($this->checkCredentials($username, $password))
        {
            // Check if the passwords match.
            if ($this->verifyPassword($password,$this->user->getHashedPassword()))
            {
                // The passwords are a match. The user is authenticated.
                $_SESSION['authenticated']='true';
                // Put the username in the $_SESSION array.
                $_SESSION['USER']['name']=$this->user->getLogonName();
                // Place the userdata (an array) into the $_SESSION
                $_SESSION['USER']['DATA']=$this->getdata();
                $_SESSION['USER']['CUSTOMER_DETAILS']=$this->getCustomerDetails();
                $_SESSION['USER']['ADDRESS']=$this->getAddressDetails();
                // The rest of the userdata.
                include 'content/frontend/GetUserDetails.php';
                // Now were done were going back to the index page.
                $_SESSION['LOGIN_ERROR']=['type'=>'success', 'message'=>'U bent ingelogd'];
                echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
            }
            else
            {
                // The passwords don't match.
                // If the user was logged in, he will be logged out now and the userdata will be cleared.
                unset($_SESSION['authenticated']);
                unset($_SESSION['USER']['DATA']);
                return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];

            }
        }
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
            $user = new UserController();
            return "Welkom, " . $user->getUsername();
        } else {
            return " | <a class='pull-right' href='/login'>Login</a> | <a class='pull-right' href='/register'>Register</a>";
        }
    }
    function role(){
        return 'role';
    }
}