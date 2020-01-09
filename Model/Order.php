<?php


namespace Model;


class Order extends Database
{
    private $orderID;
    private $customerID;
    private $orderDate;
  //  private $orderAmount;
    private $expectedDeliveryDate;
    private $lasteditedby;
    private $deliverymethodID;
    private $paymentmethodID;
    private $specialdealID;

    function __construct()
    {
        $this->table = "orders";
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
    public function getExpectedDeliveryDate()
    {
        return $this->expectedDeliveryDate;
    }

    /**
     * @param mixed $expectedDeliveryDate
     */
    public function setExpectedDeliveryDate($expectedDeliveryDate)
    {
        $this->expectedDeliveryDate = $expectedDeliveryDate;
    }

    /**
     * @return mixed
     */
    public function getLasteditedby()
    {
        return $this->lasteditedby;
    }

    /**
     * @param mixed $lasteditedby
     */
    public function setLasteditedby($lasteditedby)
    {
        $this->lasteditedby = $lasteditedby;
    }

    /**
     * @return mixed
     */
    public function getDeliverymethodID()
    {
        return $this->deliverymethodID;
    }

    /**
     * @param mixed $deliverymethodID
     */
    public function setDeliverymethodID($deliverymethodID)
    {
        $this->deliverymethodID = $deliverymethodID;
    }

    /**
     * @return mixed
     */
    public function getPaymentmethodID()
    {
        return $this->paymentmethodID;
    }

    /**
     * @param mixed $paymentmethodID
     */
    public function setPaymentmethodID($paymentmethodID)
    {
        $this->paymentmethodID = $paymentmethodID;
    }

    /**
     * @return mixed
     */
    public function getSpecialdealID()
    {
        return $this->specialdealID;
    }

    /**
     * @param mixed $specialdealID
     */
    public function setSpecialdealID($specialdealID)
    {
        $this->specialdealID = $specialdealID;
    }
    /** @return Order */
    public function getAllOrders()
    {
        $orders = new Order();
        $orders = $orders->retrieve();
        return $orders;
    }

}