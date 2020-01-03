<?php


namespace Model;


class Customer extends User
{
    private $CustomerID;
    private $PersonID;
    private $ShoppingCartID;
    private $newsletter;

    function __construct()
    {
        Parent::__construct();
        $this->table = 'Customer';
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




//`CustomerID` int(10) NOT NULL,
//`PersonID` int(10) NOT NULL,
//`ShoppingCartID` int(10) DEFAULT NULL,
//`Gender` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
//`newsletter` tinyint(4) DEFAULT NULL,
//`TermsAndConditions` tinyint(1) DEFAULT NULL
}