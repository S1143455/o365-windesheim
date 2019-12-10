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
           return $_SESSION['LOGIN_ERROR']='Vul een gebruikernaam en wachtwoord in.';
        }

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        if($user->checkCredentials())
        {
            // Check if the passwords match.
            if ($this->verifyPassword($user->getPassword(),$user->getDbPassword() ))
            {
                // The passwords are a match. The user is authenticated.
                $_SESSION['authenticated']='true';
                $_SESSION['USER']['name']=$user->getUsername();
                // Place the userdata (an array) into the $_SESSION
                $_SESSION['USER']['DATA']=$user->getUserDataArray();
                // Now were done were going back to the index page.
                $_SESSION['LOGIN_ERROR']='U bent ingelogd';
                echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
            }
            else
            {
                // The passwords don't match.
                // If the user was logged in, he will be logged out now and the userdata will be cleared.
                unset($_SESSION['authenticated']);
                unset($_SESSION['USER']['DATA']);
                return $_SESSION['LOGIN_ERROR']='Gebruikersnaam of wachtwoord onjuist.';

            }
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