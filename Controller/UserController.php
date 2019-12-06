<?php

namespace Controller;
use Model\User;

class UserController extends AuthenticationController
{
    public function getUsername()
    {
        if (isset($_SESSION['USER']))
        {
            return $_SESSION['USER']['name'];
        }
        return 'Login';
    }
    public function isAdmin()
    {
        return true;
    }

}