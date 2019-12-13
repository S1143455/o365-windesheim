<?php


namespace Model;


class Customer extends User
{
    private $CustomerID;
    private $AddressID;
    private $PersonID;
    private $ShoppingCartID;
    private $Gender;
    private $newsletter;
    private $TermsAndConditions;


    function __construct()
    {
        $this->table = "customer";
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getCustomerID()
    {
        return $this->CustomerID;
    }

    /**
     * @param mixed $CustomerID
     */
    public function setCustomerID($CustomerID)
    {
        $this->CustomerID = $CustomerID;
    }

    /**
     * @return mixed
     */
    public function getAddressID()
    {
        return $this->AddressID;
    }

    /**
     * @param mixed $AddressID
     */
    public function setAddressID($AddressID)
    {
        $this->AddressID = $AddressID;
    }

    /**
     * @return mixed
     */
    public function getPersonID()
    {
        return $this->PersonID;
    }

    /**
     * @param mixed $PersonID
     */
    public function setPersonID($PersonID)
    {
        $this->PersonID = $PersonID;
    }

    /**
     * @return mixed
     */
    public function getShoppingCartID()
    {
        return $this->ShoppingCartID;
    }

    /**
     * @param mixed $ShoppingCartID
     */
    public function setShoppingCartID($ShoppingCartID)
    {
        $this->ShoppingCartID = $ShoppingCartID;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->Gender;
    }

    /**
     * @param mixed $Gender
     */
    public function setGender($Gender)
    {
        $this->Gender = $Gender;
    }

    /**
     * @return mixed
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * @param mixed $newsletter
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * @return mixed
     */
    public function getTermsAndConditions()
    {
        return $this->TermsAndConditions;
    }

    /**
     * @param mixed $TermsAndConditions
     */
    public function setTermsAndConditions($TermsAndConditions)
    {
        $this->TermsAndConditions = $TermsAndConditions;
    }

}