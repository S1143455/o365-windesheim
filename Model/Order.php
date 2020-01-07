<?php


namespace Model;


class Order extends Database
{
    private $orderID;
    private $customerID;
    private $orderDate;
    private $orderAmount;

    private $expectedDeliveryDate;
    private $lasteditedby;
    private $deliverymethodID;
    private $paymentmethodID;
    private $specialdealID;

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

    public function setExpectedDeliveryDate($expectedDeliveryDate)
    {
        $this->expectedDeliveryDate = $expectedDeliveryDate;
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

//    public function getAllActiveOrders()
//    {
//        $orders = new Order();
//        $orders = $orders->retrieve();
//
//        return $orders;
//
//        $result = '';
//        /**
//         * $result = $this->selectStmt('SELECT * FROM order; ');
//         */
//      // $result = $this->selectStmt('SELECT * FROM order;');
//
//        return $result;
//    }

    public function getAllActiveOrders()
    {
        $orders = $this->selectStmt("SELECT SUM(si.UnitPrice) as OrderAmmount, o.OrderID, o.CustomerID, o.OrderDate, os.StockItemID FROM `order` o LEFT JOIN order_stockitem os on os.orderID = o.OrderID INNER JOIN stockitem si on os.OrderID = si.StockItemID");

        var_dump($orders);
        return $orders;
    }

}