<?php


namespace Model;


class Customer extends Database
{
    private $CustomerID;
    private $PersonID;
    private $ShoppingCartID;
    private $Newsletter;

    function __construct()
    {
        $this->table = "customer";
        parent::__construct();

    }
    /**
     * @return mixed
     */

    //If value is 1, change the value to a checked checkbox. Else create an unchecked checkbox.
    public function getNewsletter()
    {
        if ($this->Newsletter == "1"){
            $this->Newsletter =
                '<input type="checkbox" name="Newsletter" checked disabled>';

        } else {
            $this->Newsletter =
                '<input type="checkbox" name="Newsletter" disabled>';

        }
        return $this->Newsletter;
    }

    /**
     * @param mixed $Newsletter
     */
    public function setNewsletter($Newsletter)
    {
        $this->Newsletter = $Newsletter;
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