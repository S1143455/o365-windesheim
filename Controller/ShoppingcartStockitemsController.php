<?php
namespace Controller;

use Model\ShoppingcartStockitems;
use Model\Database;
use Model\File;
class ShoppingcartStockitemsController

{
    function __construct()
    {
        $this->shoppingcartstockitems = new shoppingcartstockitems();
    }

    public function retrieve($cartId){
        $shoppingcartstockitems = new shoppingcartstockitems();
        $shoppingcartstockitems = $shoppingcartstockitems->retrieve($cartId);
        return $shoppingcartstockitems;
    }
}