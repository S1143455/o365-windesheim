<?php

namespace Classes;
class Authentication
{

    private $db;

    function __construct($db)
    {
        $this->db = $db;
        if (isset($_SESSION['authenticated'])) {
            return 'Already authenticated';
        }
    }

    function login($username, $password)
    {
        $_SESSION['USER']['id'] = 12;
        $_SESSION['USER']['name'] = 'Test user';
    }

    function register($data)
    {

    }
    function logout()
    {
        if (isset($_SESSION['authenticated'])) {
            unset($_SESSION['authenticated']);
            unset($_SESSION['user']);
        }
    }

    function isAuthenticated()
    {

        if (isset($_SESSION['authenticated'])) {
            $user = new User();
            return "Welkom, " . $user->getUsername();
        } else {
            return "<a class='pull-right' href='/login.php'>Login</a> | <a class='pull-right'>Register</a>";
        }
    }
}