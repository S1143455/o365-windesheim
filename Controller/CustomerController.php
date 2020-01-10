<?php


namespace Controller;

use Model\Customer;
use Model\People;
use Model\Adress;


class CustomerController
{
    private $viewPath = 'content/frontend/';

    private $admin = 'content/backend/';
    private $route = 'content/frontend/';
    function __construct()
    {
        $this->customer = new Customer();
        $this->people = new People();

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

        //iets.php
        include  $this->viewPath . 'account-toevoegen.php';
        $this->people = new People();
        $this->addres = new Adress();

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
    function getAllCustomer()
    {
        $customers = $this->customer->getAllCustomers();

        foreach ($customers as $customer){

            $result = '';
            $result .= '<tr>
                    <td class="col-md-1"><button type="submit" class="btn btn-outline-secondary tableEditButton" name="id" value="' . $customer->getCustomerID() .'">Edit</button></td>
                    <td class="col-md-2">' . $customer->getCustomerID() . '</td> 
                    <td class="col-md-3">' . $this->customer->getEmailAddressOnID($customer->getPersonID()) .'</td>
                    <td class="col-md-3">' . $this->customer->getFullNameOnID($customer->getPersonID()) .'</td>
                    <td class="col-md-2">' . $this->customer->getLastOrderDateOnID($customer->getCustomerID()) .'</td>
                    <td class="col-md-2">' . $customer->getNewsletter() .'</td>
                </tr>';
            echo $result;
        }

    }
    //If value is 1, change the value to a checked checkbox. Else create an unchecked checkbox.
//    public function getNewsletter()
//    {
//        if ($this->newsletter == "1"){
//            $this->newsletter =
//                '<input type="checkbox" name="newsletter" checked>';
//
//        } else {
//            $this->newsletter =
//                '<input type="checkbox" name="newsletter">';
//
//        }
//        return $this->newsletter;
//    }

//    function getCustomerAndPeople()
//    {
//        $customers = $this->customer->getAllCustomers();
//
//        foreach ($customers as $customer){
//
//            $result = '';
//            $result =
//        }
//    }

    public function createBE()
    {
        print_r($_POST);
        $this->customer = new Customer();
        $this->customer->initialize();

        $this->store($this->customer);

        include $this->admin . 'onderhoudklanten.php';
    }
    function Test_Input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
//                    var_dump($value);
                    if($value == "on"){
                        $this->customer->setTermsAndConditions(1);
                    }else{
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
        $this->customer->setPersonID($this->people->getPersonID());
        $this->store($this->customer);
       //iets.php
        include $this->route . 'account-toevoegen.php';
    }

    /**
     * Stores the product in the database.
     *
     * @param $customer Customer
     * @param $customer customer
     * @return string
     */

    public function store($customer)
    {
//        var_dump($customer);
        if (!$customer->initialize())
        {
        var_dump($customer);
}
        if (!$customer->initialize()) {
            print_r($_GET);
            return false;
        };

        $this->customer = $customer;

        if (!$this->customer->save()) {
            return "Something went wrong.";
        }
    }
    /**
     * Stores the product in the database.
     *
     * @param $people People
     * @return string
     */
    public function storePeople($people)
    {
//        var_dump($people);
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