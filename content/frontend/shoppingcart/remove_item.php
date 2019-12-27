<?php
if (!isset($_SESSION['authenticated']))
{
    echo display_message('info','Om bestellingen te kunnen bewerken moet u ingelogd zijn.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/login\">";
    die;
}

$cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
$stockItem=$_POST['remove'];
$handelData=new \Model\Database();

// A function to add to the stock.
function addToStock($stockItem)
{
    $handelData=new \Model\Database();
    // if an item is removed from the cart. We need to add the stockqty with one.
    $qtyInStock = $handelData->selectStmt("select QuantityOnHand  from stockitemholdings where StockItemID=" . $stockItem);
    $newQty = $qtyInStock[0]['QuantityOnHand'] + 1;
    $updateStock=$handelData->UpdateStmt("UPDATE stockitemholdings set QuantityOnHand=" . $newQty . " where StockItemID=" . $stockItem);
    return;
}

// Lower the number of items in the cart.
$amountOfItemsPresent=$handelData->selectStmt("select *  from shoppingcart_stockitems where StockItemID=". $stockItem . " and ShoppingCartID=".$cartId);
if ($amountOfItemsPresent)
{
    $newAmount = $amountOfItemsPresent[0]['StockItemAmount'] - 1;

    $updateItem = $handelData->UpdateStmt("UPDATE shoppingcart_stockitems SET StockItemAmount=" . $newAmount . " where  ShopStockID= " . $amountOfItemsPresent[0]['ShopStockID'] . " and ShoppingCartID=" . $cartId);
    $updateStock = addToStock($stockItem);

// If the amount reaches 0, the row needs to be deleted for the cart.
    if ($newAmount == 0)
    {
        $removeCartItem = $handelData->UpdateStmt("Delete from shoppingcart_stockitems where StockItemID=" . $stockItem . " and ShoppingCartID=" . $cartId);
    }
}
echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";