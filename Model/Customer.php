<?php


namespace Model;


class Customer extends Database
{
    private $CustomerID;
    private $PersonID;
    private $ShoppingCartID;
    private $newsletter;

    function __construct()
    {
        Parent::__construct();
        $this->table = 'customer';
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

    //If value is 1, change the value to a checked checkbox. Else create an unchecked checkbox.
    public function getNewsletter()
    {
        if ($this->newsletter == "1"){
            $this->newsletter =
                '<input type="checkbox" name="newsletter" checked>';

        } else {
            $this->newsletter =
                '<input type="checkbox" name="newsletter">';

        }
        return $this->newsletter;
    }
    public function setnewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
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





//`CustomerID` int(10) NOT NULL,
//`PersonID` int(10) NOT NULL,
//`ShoppingCartID` int(10) DEFAULT NULL,
//`Gender` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
//`newsletter` tinyint(4) DEFAULT NULL,
//`TermsAndConditions` tinyint(1) DEFAULT NULL

    /**
     * @return mixed
     */

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