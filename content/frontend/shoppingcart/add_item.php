<?php
// We need to check if the users is logged in.
if (!isset($_SESSION['authenticated']))
{
    echo display_message('info','Om te kunnen bestellen moet u ingelogd zijn.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/login\">";
    die;
}

// If the user is logged in, we need to check if the user has a cart.
if (!$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'])
{
    // No cart is present. So we need to create one.
    include 'content/frontend/shoppingcart/create_cart.php';
}

// There's a cart present. Let's put the the item in the cart.
$cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
$stockItem=$_POST['add'];
$handelData=new \Model\Database();

function LowerStock($stockItem)
{
    $handelData=new \Model\Database();
    // if an item is in a cart. We need to lower the stockqty with one.
    $qtyInStock = $handelData->selectStmt("select QuantityOnHand  from stockitemholdings where StockItemID=" . $stockItem);
    $newQty = $qtyInStock[0]['QuantityOnHand'] - 1;
    $updateStock=$handelData->UpdateStmt("UPDATE stockitemholdings set QuantityOnHand=" . $newQty . " where StockItemID=" . $stockItem);
    return;
}

$itemAlreadyPresent=$handelData->selectStmt("select count(*) as present from shoppingcart_stockitems where StockItemID=". $stockItem );
if ($itemAlreadyPresent[0]['present']==0) // The selected item is not present in the cart.
{
    $insertItem=$handelData->UpdateStmt("INSERT INTO shoppingcart_stockitems(ShoppingCartID, StockItemID, StockItemAmount) VALUES (" . $cartId . "," . $stockItem . ",1)");
    $updateStock=LowerStock($stockItem);
}
else // If the item is already in the cart we need to add one more.
{
    $amountOfItemsPresent=$handelData->selectStmt("select *  from shoppingcart_stockitems where StockItemID=". $stockItem );
    $newAmount=$amountOfItemsPresent[0]['StockItemAmount']+1;
    $updateItem=$handelData->UpdateStmt("UPDATE shoppingcart_stockitems SET StockItemAmount=" . $newAmount . " where  ShopStockID= " . $amountOfItemsPresent[0]['ShopStockID']);
    $updateStock=LowerStock($stockItem);
}

echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";
