<?php


namespace Controller;

use Model\Customer;
use Model\Order;
use Model\People;
use Model\Adress;


class CustomerController
{
    private $admin = 'content/backend/';
    private $route = 'content/frontend/';
    private $viewPath = 'content/frontend/';

    function __construct()
    {
        $this->customer = new Customer();
        $this->people = new People();
        $this->adress = new Adress();
        $this->order = new Order();


    }
    /**
     * This method should capture the creation of a new object,
     * Verify its data and commit it to the database.
     * @param $newCustomer
     * @return mixed
     */
    public function createR()
    {
        $this->customer = new Customer();
        $this->customer->setCustomerID(10);
        include  $this->viewPath . 'account-toevoegen.php';
        $this->people = new People();
        $this->adress = new Adress();

    }
    public function retrieve($id){
        $customer = new customer();
        $customer = $customer->retrieve($id);
        if(empty($customer->getCustomerID()))
        {
            //header("Location: /404", true);
        }

        return $customer;
    }
    public function retrievePerson($id){
        $person = new People();
        $person = $person->retrieve($id);
        if(empty($person->getPersonID()))
        {
            //header("Location: /404", true);
        }

        return $person;
    }

    public function retrieveOrder($CustomerID){
        $order = new Order();
        $order = $this->order->where("*", "CustomerID", "=", $CustomerID);
        if(empty($order))
        {
            //header("Location: /404", true);
        }

        return $order;
    }

    public function getallcustomers(){
        $customers = $this->customer->getAllCustomers();
        return $customers;
    }
    public function SearchCustomers($value){
        $customers = $this->customer->getAllCustomers();
//        $people
        var_dump($customers);

        $input = preg_quote('bl', '~'); // don't forget to quote input string!
        $data = array('orange', 'blue', 'green', 'red', 'pink', 'brown', 'black');

        $result = preg_grep('~' . $input . '~', $data);
        return $customers;
    }
    function getAllCustomer($customers)
    {

        foreach ($customers as $customer){
            $person =  $this->retrievePerson($customer->getPersonID());
            $orderdate = $this->order->where("MAX(OrderDate)","CustomerID","=",$customer->getCustomerID());

            $result = '';
            $result .= '<tr>
                    <td class="col-md-1"><button type="submit" class="btn btn-outline-secondary tableEditButton" name="id" value="' . $customer->getCustomerID() .'">Edit</button></td>
                    <td class="col-md-2">' . $customer->getCustomerID() . '</td>                 
                    <td class="col-md-3">' . $person->getEmailAddress() .'</td>
                    <td class="col-md-3">' . $person->getFullName() .'</td>
                    <td class="col-md-2">' . $this->customer->getLastOrderDateOnID($customer->getCustomerID()) .'</td>
                    <td class="col-md-1">' . $customer->getNewsletter() .'</td>
                </tr>';
            echo $result;
        }

    }


    public function createBE()
    {
        $this->customer = new Customer();
        $this->customer->initialize();

        $this->store($this->customer);

        include $this->admin . 'onderhoudklanten.php';
    }

    public function createMultipleP(){

        $this->customer = new Customer();
        $this->people = new People();
        $this->people->setIsSystemUser(0);
        $this->people->setRole("CUSTOMER");
        $this->people->setPhoto(NULL);
        $this->people->setLastEditedBy(1);
        foreach ($_POST as $key => $value)
        {
           // var_dump($key);

            switch ($key)
            {
                case "FullName":
                    $this->people->setFullName($value);
                    break;
                case "LogonName":
                    $this->people->setLogonName($value);
                    break;
                case "EmailAddress":
                    $this->people->setEmailAddress($value);
                    break;
                case "PhoneNumber":
                    $this->people->setPhoneNumber($value);
                    break;
                case "NewsLetter":
                    if($value == "on"){
                        $this->customer->setNewsLetter(1);
                    }else{
                        $this->customer->setNewsLetter(0);
                    }
                    break;
                case "TermsAndConditions":
                    if($value == "on"){
                        $this->customer->setTermsAndConditions(1);
                    }
                    break;
                case "Gender":
                    $this->customer->setGender($value);
                    break;
                case "HashedPassword":
                    $this->people->setHashedPassword(password_hash($value,PASSWORD_BCRYPT));
                    break;
                case  "dateofbirth":
                    $this->people->setDateOfBirth($value);
                    break;
                default:
                    //var_dump($key);


 // PersonID,
                // FullName,
                // LogonName,
                // HashedPassword,
                // PhoneNumber,
                // EmailAddress,
                // IsSystemUser,
                // Role,
                // DateOfBirth,
                // Photo,
                // LastEditedBy,
                // PassWordRecoveryString,
                // RecoveryStringTTL
 // CustomerID, AddressID, ShoppingCartID, Gender, newsletter, TermsAndConditions,



            }
            //var_dump($value);
            //var_dump($key);
        }
        $this->storePeople($this->people);
    }

    /**
     * Stores the product in the database.
     *
     * @param $customer customer
     * @param $customer Customer
     * @return string
     */

    public function store($customer)
    {

        if (!$customer->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->customer = $customer;

        if (!$this->customer->save()) {
            return "Something went wrong.";
        }
    }

    public function update()
    {

        $this->customer = new Customer();
        $this->customer->initialize();
        //ingelogde gebruiker
        $this->people->setLastEditedBy(1);
        if ($_POST["CustomerID"]) {
            foreach ($_POST["CustomerID"] as $id) {
                $this->customer->retrieve($id);
                $this->customer->setCustomerID($this->customer->getCustomerID());
                $this->store($this->customer);
            }
        }
        if ($_POST["PersonID"]){
            foreach ($_POST["PersonID"] as $id) {
                $this->people->retrieve($id);
                $this->people->setPersonID($this->people->getPersonID());
                $this->storePeople($this->people);
            }
        }
        $this->store($this->customer);
        include $this->admin . 'onderhoudklanten.php';
        return "";

    }

    /**
     * Stores the product in the database.
     *
     * @param $people People
     * @return string
     */
    public function storePeople($people)
    {
        if (!$people->initialize())
        {
            return false;
        };
        $this->people = $people;

        if (!$this->people->save())
        {
            return "Something went wrong.";
        }
    }
}