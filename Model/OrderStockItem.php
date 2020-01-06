<?php


namespace Model;


class OrderStockItem extends Database
{
    private $orderstockitemID;
    private $stockitemID;
    private $orderID;
    function __construct()
    {
        $this->table = "order_stockitem";
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getOrderstockitemID()
    {
        return $this->orderstockitemID;
    }

    /**
     * @param mixed $orderstockitemID
     */
    public function setOrderstockitemID($orderstockitemID)
    {
        $this->orderstockitemID = $orderstockitemID;
    }

    /**
     * @return mixed
     */
    public function getStockitemID()
    {
        return $this->stockitemID;
    }

    /**
     * @param mixed $stockitemID
     */
    public function setStockitemID($stockitemID)
    {
        $this->stockitemID = $stockitemID;
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



}