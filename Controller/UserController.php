<?php

namespace Controller;
use Model\User;

class UserController extends AuthenticationController
{
    function __construct()
    {
        $this->user = new User();
    }
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
    public function retrievebylogin($return, $key, $id){
        $user = $this->user->databaseWhere($return,$key,$id);
        return $user;
    }
    public function GetEmailByName($return, $key, $id){
        $user = $this->user->databaseWhere($return,$key,$id);
        var_dump($user);
        return true;
    }
}

