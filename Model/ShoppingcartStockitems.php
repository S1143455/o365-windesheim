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

    public function getShopStockID()
    {
        return $this->ShopStockID;
    }

    public function getShoppingCartID()
    {
        return $this->ShoppingCartID;
    }

    public function getStockItemID()
    {
        return $this->StockItemID;
    }

    public function getStockItemAmount()
    {
        return $this->StockItemAmount;
    }

    public function getAllShoppingcartStockItems()
    {
        $shoppingcartstockitems = new ShoppingcartStockitems();
        $shoppingcartstockitems = $shoppingcartstockitems->retrieve();
        return $shoppingcartstockitems;
    }


}



