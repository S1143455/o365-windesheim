<?php

namespace Controller;
class Authentication
{

    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    function login($username, $password)
    {
        $_SESSION['USER']['id'] = 12;
        $_SESSION['USER']['name'] = $username; //'Test user';
        $_SESSION['authenticated']='TRUE';
    }

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
            //$user = new User();
            $user = new User('');
            return "Welkom, " . $user->getUsername();
        } else {
//<<<<<<< HEAD:Classes/Authentication.php
//            return "<a class='pull-right' href='/login'>Login</a> | <a href='/content/account-toevoegen.php' class='pull-right'>Register</a>";
//=======
//            return " | <a class='pull-right' href='/login'>Login</a> | <a class='pull-right' href='/register'>Register</a>";
//>>>>>>> b2bb1f4d544f81dcbbf97a44c468f2323b034549:Controller/Authentication.php
        }
    }

}