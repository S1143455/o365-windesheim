<?php
namespace Controller;

use Model\ShoppingcartStockitems;
use Model\Database;
class ShoppingcartStockitemsController

{
    function __construct()
    {
        $this->shoppingcartstockitems = new ShoppingcartStockitems();
    }

    public function retrieve(){
        $ShoppingcartStockitem = new ShoppingcartStockitems();
        $ShoppingcartStockitem = $ShoppingcartStockitem->retrieve();
        return $ShoppingcartStockitem;
    }

    public function where($field,$value){
        $ShoppingcartStockitem = new ShoppingcartStockitems();
        $ShoppingcartStockitem = $ShoppingcartStockitem->where("*",$field,"=",$value);
        return $ShoppingcartStockitem;

    }

    function getAllItems()
    {
        $result=array();
        $ShoppingcartStockitems = $this->shoppingcartstockitems->getAllShoppingcartStockItems();
        foreach ($ShoppingcartStockitems as $ShoppingcartStockitem){
            if ($ShoppingcartStockitem->getShoppingCartID()==$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']) {
                $temp_array = array(
                    "ShopStockID" => $ShoppingcartStockitem->getShopStockID(),
                    "ShoppingCartID" => $ShoppingcartStockitem->getShoppingCartID(),
                    "StockItemID" => $ShoppingcartStockitem->getStockItemID(),
                    "StockItemAmount" => $ShoppingcartStockitem->getStockItemAmount(),
                );
                array_push($result,$temp_array);
            }


        }
        return $result;
    }

}
