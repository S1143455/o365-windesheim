<?php


namespace Controller;

use Model\Customer;
use Model\People;

class CustomerController
{
    private $viewPath = 'content/frontend/';

    private $admin = 'content/backend/';

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
    }
    public function retrieve($id){
        $discount = new discount();
        $discount = $discount->retrieve($id);
        if(empty($discount->getCategoryID()))
        {
            //header("Location: /404", true);
        }

        return $discount;
    }
    function getAllCustomer()
    {
        $customers = $this->customer->getAllCustomers();

        foreach ($customers as $customer){
            $customerId = $customer->getCustomerID();
            $personId = $customer->getPersonID();

            $result = '';
            $result .= '<tr>
                    <td class="col-md-1"><button type="submit" name="id" value="' . $customer->getCustomerID() .'">Edit</button></td>
                    <td class="col-md-2">' . $customer->getCustomerID() . '</td>
                    <td class="col-md-3">' . $email = $customer->getEmailAddressOnID($personId) . '</td>
                    <td class="col-md-3">' . $customer->getFullNameOnID($personId) .'</td>
                    <td class="col-md-2">' . $customer->getLastOrderDateOnID($customerId) .'</td>
                    <td class="col-md-2">' . $customer->getNewsletter() .'</td>
                </tr>';
            echo $result;
        }

    }

    public function create()
    {
        print_r($_POST);
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
        var_dump($this->people);
        var_dump($this->customer);
    }

    /**
     * Stores the product in the database.
     *
     * @param $customer Customer
     * @return string
     */
    public function store($customer)
    {
        var_dump($customer);
        if (!$customer->initialize())
        {
            print_r($_GET);
            return false;
        };

        $this->customer = $customer;

        if (!$this->customer->save())
        {
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
        var_dump($people);
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