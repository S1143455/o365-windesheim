<?php


namespace Model;


class Order extends Database
{
    private $orderstockitemID;
    private $customerID;
    private $orderDate;

    function __construct()
    {
        $this->table = "order";
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getOrderID()
    {
        return $this->orderID;
    }

    /**
     * @param mixed $orderID
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
    }

    /**
     * @return mixed
     */
    public function getCustomerID()
    {
        return $this->customerID;
    }

    /**
     * @param mixed $customerID
     */
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param mixed $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return mixed
     */
    public function getOrderAmmount()
    {
        return $this->orderAmmount;
    }

    /**
     * @param mixed $orderAmmount
     */
    public function setOrderAmmount($orderAmmount)
    {
        $this->orderAmmount = $orderAmmount;
    }

    public function getAllActiveOrderStockItems()
    {
        $orders = new Order();
        $orders = $orders->retrieve();
        return $orders;

//
//        $result = '';
//        /**
//         * $result = $this->selectStmt('SELECT * FROM order; ');
//         */
//      // $result = $this->selectStmt('SELECT * FROM order;');
//
//        return $result;
    }

}