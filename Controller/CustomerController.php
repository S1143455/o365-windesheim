<?php


namespace Controller;

use Model\Customer;
use Model\People;

class CustomerController
{
    private $admin = 'content/backend/';

    function __construct()
    {
        $this->customer = new Customer();
        $this->people = new People();
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
        var_dump($this->customer);

//        $this->customer->setLastEditedBy(1);

        $this->store($this->customer);

        // return "true";
        // include $this->contentpath
        include $this->admin . 'onderhoudklanten.php';
    }

    /**
     * Stores the product in the database.
     *
     * @param $customer customer
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
}