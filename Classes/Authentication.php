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

    }
    function register($data)
    {

    }
}