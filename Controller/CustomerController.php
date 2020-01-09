<?php


namespace Controller;

use Model\Customer;
use Model\People;
use Model\Adress;


class CustomerController
{
    private $admin = 'content/backend/';
    private $route = 'content/frontend/';

    function __construct()
    {
        $this->customer = new Customer();
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
        //var_dump($this->customer);

//        $this->customer->setLastEditedBy(1);

        $this->store($this->customer);

        // return "true";
        // include $this->contentpath
        include $this->admin . 'onderhoudklanten.php';
    }
    /**
     * This method should capture the creation of a new object,
     * Verify its data and commit it to the database.
     * @param $newCustomer
     * @return mixed
     */
    public function create()
    {
        $this->customer = new Customer();
        $this->customer->setCustomerID(10);

        //iets.php
        include $this->route . 'account-toevoegen.php';
    }

    /**
     * Stores the product in the database.
     *
     * @param $customer customer
     * @return string
     */

    public function store($customer)
    {
        //var_dump($customer);

        if (!$customer->initialize()) {
            print_r($_GET);
            return false;
        };

        $this->customer = $customer;

        if (!$this->customer->save()) {
            return "Something went wrong.";
        }
    }


}