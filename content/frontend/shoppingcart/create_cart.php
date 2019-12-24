<?php
$handelData=new \Model\Database();
$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];

// Let's create a cart.
$creationDate=date('Y-m-d' ,time());
$expirationDate=date('Y-m-d', time() + (14 * 86400)); // A cart is valid for 14 days.
$createCart=$handelData->UpdateStmt("INSERT INTO shoppingcart(CustomerID, ExpirationDate, CreationDate) VALUES (" . $customerId . ",'" . $expirationDate . "','" . $creationDate  . "')");

// Now the cart is made we need to update the customertable.
// First we need the cartid.
$getCartId=$handelData->selectStmt("select ShoppingCartID from shoppingcart where CustomerID=" . $customerId .";");

// Now we can place the cartId in the table.
$updateCustomer=$handelData->UpdateStmt("update customer set ShoppingCartID=" . $getCartId[0]['ShoppingCartID'] . " where CustomerID=" . $customerId .";");

// We also need to update the array.
$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']=$getCartId[0]['ShoppingCartID'];
