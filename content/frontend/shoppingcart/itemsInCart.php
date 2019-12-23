<?php

// check if there are any items in the cart
function getAmountOfItemsInCart(){
    // check if the user is logged in.
    if (!isset($_SESSION['authenticated']))
    {
        // nothing to count.
        return false;
    }

// check if the user has a cart.
    if (!isset($_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']))
    {
        // No cart present.
        return false;
    }

    $handelData=new \Model\Database();
    $cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];

    $amountOfItemsPresent=$handelData->selectStmt("select sum(StockItemAmmount) as amount  from shoppingcart_stockitems where ShoppingCartID='".$cartId ."'");
    if ($amountOfItemsPresent){
        return $amountOfItemsPresent[0]['amount'];
    }
    return false;
}



