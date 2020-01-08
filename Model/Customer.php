<?php


namespace Model;


class Customer extends Database
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

    //If value is 1, change the value to a checked checkbox. Else create an unchecked checkbox.
    public function getNewsletter()
    {
        return $this->newsletter;
    }
    public function setNewsLetter($newsletter)
    {
        $this->newsletter = $newsletter;
    }

  
    public function getAllCustomers(){

        $customers = new Customer();
        $customers = $customers->retrieve();
        return $customers;

    }

    public function getEmailAddressOnID($id){
        $result = $this->selectStmt('SELECT pe.EmailAddress FROM people AS pe INNER JOIN customer AS cu ON pe.PersonID = cu.PersonID WHERE pe.PersonID = '. $id .';');
        return $result[0][0];
    }

    public function getFullNameOnID($id){
        $result = $this->selectStmt('SELECT pe.FullName FROM people AS pe INNER JOIN customer AS cu ON pe.PersonID = cu.PersonID WHERE pe.PersonID = '. $id .';');
        return $result[0][0];
    }

    public function getLastOrderDateOnID($id){
        $result = $this->selectStmt('SELECT MAX(OrderDate) AS "Last Order" FROM `order` WHERE CustomerID = '. $id .';');
        return $result[0][0];
    }
}