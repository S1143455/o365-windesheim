<?php

namespace Controller;
class User extends Authentication
{
    public function getUsername()
    {
        if (isset($_SESSION['USER']))
        {
            return $_SESSION['USER']['name'];
        }
        return 'Login';
    }
}