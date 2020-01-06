<?php

namespace Controller;
use Model\Customer;

Class CustomerController
{
    private $route = 'content/frontend/';

    function __construct()
    {
        $this->customer = new Customer();
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


}