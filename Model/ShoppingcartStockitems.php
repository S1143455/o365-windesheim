<?php

namespace Model;


class ShoppingcartStockitems extends Database
{
    private $ShopStockID;
    private $ShoppingCartID;
    private $StockItemID;
    private $StockItemAmount;

    function __construct()
    {
        $this->table = "shoppingcart_stockitems";
        parent::__construct();
    }
    /**
     * @return mixed
     */
    public function getShopStockID()
    {
        return $this->ShopStockID;
    }

    /**
     * @param mixed $ShopStockID
     */
    public function setShopStockID($ShopStockID)
    {
        $this->ShopStockID = $ShopStockID;
    }

    /**
     * @return mixed
     */
    public function getShoppingCartID()
    {
        return $this->ShoppingCartID;
    }

    /**
     * @param mixed $ShoppingCartID
     */
    public function setShoppingCartID($ShoppingCartID)
    {
        $this->ShoppingCartID = $ShoppingCartID;
    }

    /**
     * @return mixed
     */
    public function getStockItemID()
    {
        return $this->StockItemID;
    }

    /**
     * @param mixed $StockItemID
     */
    public function setStockItemID($StockItemID)
    {
        $this->StockItemID = $StockItemID;
    }

    /**
     * @return mixed
     */
    public function getStockItemAmount()
    {
        return $this->StockItemAmount;
    }

    /**
     * @param mixed $StockItemAmount
     */
    public function setStockItemAmount($StockItemAmount)
    {
        $this->StockItemAmount = $StockItemAmount;
    }

    /**
     * @return ShoppingcartStockitems
     */
    public function getAllShoppingcartStockItems()
    {
        $ShoppingcartStockitems = new ShoppingcartStockitems();
        $ShoppingcartStockitems = $ShoppingcartStockitems->retrieve();
        return $ShoppingcartStockitems;

    }



}



