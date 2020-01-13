<?php


namespace Model;


class Customer extends Database
{
    private $CustomerID;
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


    /**
     * @return mixed
     */
    public function getNewsletter()
    {
        if ($this->newsletter == "1"){
            $this->newsletter =
                '<input type="checkbox" name="Newsletter" checked>';

        } else {
            $this->newsletter =
                '<input type="checkbox" name="Newsletter">';

        }
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


    public function getLastOrderDateOnID($id){
        //er is op dit moment geen betere manier om een max op te halen, indien we meer tijd hadden, hadden we hier een oplossing voor gemaakt..
        $result = $this->selectStmt('SELECT MAX(OrderDate) AS "Last Order" FROM `orders` WHERE CustomerID = '. $id .';');
        if(!empty($result)){
            return $result[0][0];
        }
    }
}