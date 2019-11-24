<?php

namespace classes;
class User
{
    function __construct()
    {
    }

    public function getUsername()
    {
        if (isset($_SESSION['user']))
        {
            return $_SESSION['user']['name'];
        }
    }
}