<?php

namespace Controller;
use Model\Adress;

class AdressController
{

    function __construct()
    {
        $this->adress = new Adress();

    }
    public  function retrieveWhereP($personID){
        $address = new Adress();
        $address = $address->where("*", "PersonID", "=", $personID);
        if(empty($address))
        {
           // return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
        }
        else
        {
            return $address[0];
        }


    }

    public function retrieve($id){
        $adress = new Adress();
        $adress = $adress->retrieve($id);
        var_dump($adress);
        if(empty($adress->getAddressId()))
        {
            //header("Location: /404", true);
        }

        return $adress;
    }

    public function create()
    {
        $this->adress = new Adress();
        $this->adress->initialize();
        $this->adress->setLastEditedBy(2);
        $this->store($this->adress);

        //include $this->admin . 'onderhoudc.php';
    }


    /**
     * Stores the product in the database.
     *
     * @param $adress Adress
     * @return string
     */
    public function store($adress)
    {
        if (!$adress->initialize())
        {
            return false;
        };
        $this->adress = $adress;

        if (!$this->category->save())
        {
            return "Something went wrong.";
        }
    }

    /**
     * Stores the product in the database.
     *
     * @param $adress Adress
     * @return string
     */
    public function update($adress)
    {
        $this->store($adress);

    }



}