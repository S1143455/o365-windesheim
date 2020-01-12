<?php

namespace Model;

class Adress extends Database
{
    private $AddressId;
    private $Address;
    private $Zipcode;
    private $City;
    private $PersonId;

    function __construct()
    {
        parent::__construct();
        $this->table = "address";

    }

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->AddressId;
    }

    /**
     * @param mixed $AddressId
     */
    public function setAddressId($AddressId)
    {
        $this->AddressId = $AddressId;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param mixed $Address
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->Zipcode;
    }

    /**
     * @param mixed $Zipcode
     */
    public function setZipcode($Zipcode)
    {
        $this->Zipcode = $Zipcode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * @param mixed $City
     */
    public function setCity($City)
    {
        $this->City = $City;
    }

    /**
     * @return mixed
     */
    public function getPersonId()
    {
        return $this->PersonId;
    }

    /**
     * @param mixed $PersonId
     */
    public function setPersonId($PersonId)
    {
        $this->PersonId = $PersonId;
    }

    /**
     * @return mixed
     */
    public function getLastEditedBy()
    {
        return $this->LastEditedBy;
    }

    /**
     * @param mixed $LastEditedBy
     */
    public function setLastEditedBy($LastEditedBy)
    {
        $this->LastEditedBy = $LastEditedBy;
    }
    private $LastEditedBy;


}