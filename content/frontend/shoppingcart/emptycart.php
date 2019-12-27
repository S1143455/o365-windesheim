<?php
// Check if there's something to remove.
if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'])
{
    $handelData=new \Model\Database();
    $cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
    $customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];

    // First the customer table will be updated.
    $updateCustomer=$handelData->UpdateStmt("update customer set ShoppingCartID= null where CustomerID=" . $customerId .";");

    // We also need to remove all the items in the cart.
    $getCartContense=$handelData->selectStmt('select * from shoppingcart_stockitems');
    foreach ($getCartContense as $item)
    {
        $amountInCart=$item['StockItemAmount'];
        $stockItem=$item['StockItemID'];
        $qtyInStock = $handelData->selectStmt("select QuantityOnHand  from stockitemholdings where StockItemID=" . $stockItem) ;
        $newQty = $qtyInStock[0]['QuantityOnHand'] + $amountInCart;
        $updateStock=$handelData->UpdateStmt("UPDATE stockitemholdings set QuantityOnHand=" . $newQty . " where StockItemID=" . $stockItem );
    }
    // Remove all rows..
    $removeCartItems=$handelData->UpdateStmt("Delete from shoppingcart_stockitems where ShoppingCartID=".$cartId);

    //Than we need to remove the cart itself.
    $removeCart=$handelData->UpdateStmt("Delete from shoppingcart where ShoppingCartID=".$cartId);

    // And last we need to update the array.
    $_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']='';

    // Let's let the user know te operation went successfully.
    echo display_message('success','Uw winkelwagen is met succes verwijderd.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
    die;
}
// If there's nothing the remove we're done.
echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/\">";
