<?php

namespace Controller;
use Model\User;

class AuthenticationController
{
    function __construct()
    {

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
            $_SESSION['LOGIN_ERROR']='Vul een gebruikernaam en wachtwoord in.';
            //return 'Vul een gebruikernaam en wachtwoord in.';
        }

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        if($user->checkCredentials())
        {
            $user->getPassword();
            $this->verifyPassword($password, $user->getPassword());
        }
    }

    /**
     * Hash the users password on registration.
     * @param $password
     * @return bool|string
     */
    private function hashPassword($password)
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
            //$user = new UserController();
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