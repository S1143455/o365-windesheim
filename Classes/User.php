<?php

namespace classes;
class User extends Authentication
{
    public function getUsername()
    {
        if (isset($_SESSION['user']))
        {
            return $_SESSION['user']['name'];
        }
        return 'Login';
    }
}