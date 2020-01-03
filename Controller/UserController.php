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


    /**
     * Stores the product in the database.
     *
     * @param $user User
     * @return string
     */
    public function store($user)
    {
        if (!$user->initialize())
        {
            return false;
        };
        $this->user = $user;

        if (!$this->user->save())
        {
            return "Something went wrong.";
        }
    }

    /**
     * Stores the product in the database.
     *
     * @param $user1 User
     * @return string
     */
    public function update($user1)
    {
        $this->store($user1);

    }


}

