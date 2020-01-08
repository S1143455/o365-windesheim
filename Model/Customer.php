<?php


namespace Model;


class Customer extends Database
{
    private $CustomerID;
<<<<<<< HEAD

=======
>>>>>>> 30e993e85d6bf3250c551600a75f0c7332055670
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

<<<<<<< HEAD
    //If value is 1, change the value to a checked checkbox. Else create an unchecked checkbox.
    public function getNewsletter()
    {
        return $this->newsletter;
    }
    public function setNewsLetter($newsletter)
    {
        $this->newsletter = $newsletter;
    }

  
=======

//`CustomerID` int(10) NOT NULL,
//`PersonID` int(10) NOT NULL,
//`ShoppingCartID` int(10) DEFAULT NULL,
//`Gender` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
//`newsletter` tinyint(4) DEFAULT NULL,
//`TermsAndConditions` tinyint(1) DEFAULT NULL

    /**
     * @return mixed
     */

>>>>>>> 30e993e85d6bf3250c551600a75f0c7332055670
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

    public function getDateOfBirthOnID($id)
    {
        $result = $this->selectStmt('SELECT pe.DateOfBirth FROM people AS pe INNER JOIN customer AS cu ON pe.PersonID = cu.PersonID WHERE pe.PersonID = ' . $id . ';');
        return $result[0][0];
    }

    public function getAddressOnID($id)
    {
        $result = $this->selectStmt('SELECT ad.Address FROM address AS ad INNER JOIN people AS pe ON pe.PersonID = ad.PersonID WHERE pe.PersonID = ' . $id . ';');
        return $result[0][0];
    }

    public function getZipCodeOnID($id)
    {
        $result = $this->selectStmt('SELECT ad.ZipCode FROM address AS ad INNER JOIN people AS pe ON pe.PersonID = ad.PersonID WHERE pe.PersonID = ' . $id . ';');
        return $result[0][0];
    }

    public function getCityOnID($id)
    {
        $result = $this->selectStmt('SELECT ad.City FROM address AS ad INNER JOIN people AS pe ON pe.PersonID = ad.PersonID WHERE pe.PersonID = ' . $id . ';');
        return $result[0][0];
    }
}