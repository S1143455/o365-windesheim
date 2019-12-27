<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

// The payment was a success!
// Now we need to insert the oder into the database and empty
// the shopping cart. Also the shopping cart part of the $_SESSION
// needs to be unset.

// Let's check if the user want's to return home.
if (isset($_POST{'ReturnHome'})){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/\">";die;}

$cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
$paymentmethod=$_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD'];
$oderDate=Date('Y-m-d', time());
$handelDataBase=new \Model\Database();

// Get the paymentmethod.
$paymentMethodID=$handelDataBase->selectStmt('select PaymentMethodID from paymentmethod where lower(PaymentMethodName)="' . $paymentmethod . '"');

// Check is there was a discount used.
if(isset($_SESSION['USER']['SHOPPING_CART']['DISCOUNT']['SpecialDealID']))
{
    $specialDealId=$_SESSION['USER']['SHOPPING_CART']['DISCOUNT']['SpecialDealID'];
}
else
{
    $specialDealId=0;
}

// Put the order into the database
$insertPart1="INSERT INTO orders (CustomerID, OrderDate, LastEditedBy, DeliveryMethodID, PaymentMethodID, SpecialDealID)";
$insertPart2=" VALUES (" . $_SESSION['USER']['DATA'][0]['PersonID'] . ",'" . // CustomerID
                $oderDate. "'," .                                            // OrderDate
                $_SESSION['USER']['DATA'][0]['PersonID'] . "," .             // LastEditedBy
                1 . ",".                                                     // DeliveryMethodID
                $paymentMethodID[0]['PaymentMethodID']  . "," .              // PaymentMethodID
                $specialDealId . ");";                                       // SpecialDealID
            $insertOder=$handelDataBase->UpdateStmt($insertPart1.$insertPart2);

// Retrieve the order ID
$getOrderId=$handelDataBase->selectStmt( "select OrderID from orders where CustomerID=" . $_SESSION['USER']['DATA'][0]['PersonID'] ." and OrderDate = '" . $oderDate . "' order by OrderId desc limit 1");
$oderId=$getOrderId[0]['OrderID'];

// Put the ordered items in th database
$insertPart1="INSERT INTO order_stockitem(OrderID, StockItemID, ItemAmount, TotalCartPrice)";
foreach ($_SESSION['USER']['SHOPPING_CART']['ITEMS'] as $key)
{
    $insertPart2=" VALUES(".$oderId. ","
        .$key['StockItemID'] . ","
        .$key['StockItemAmount'] . ","
        .$key['CartPrice'].")";
    $insertOderItems=$handelDataBase->UpdateStmt($insertPart1.$insertPart2);
}

// Empty the shoppingcart.
// First the customer table will be updated.
$updateCustomer=$handelDataBase->UpdateStmt("update customer set ShoppingCartID= null where CustomerID=" . $customerId .";");

// Remove all rows..
$removeCartItems=$handelDataBase->UpdateStmt("Delete from shoppingcart_stockitems where ShoppingCartID=".$cartId);

//Than we need to remove the cart itself.
$removeCart=$handelDataBase->UpdateStmt("Delete from shoppingcart where ShoppingCartID=".$cartId);

// Unset the $_SESSION
$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']='';
unset($_SESSION['USER']['SHOPPING_CART']);

// Let's let the user know all went well.
?>
<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="">
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4><span class="glyphicon glyphicon-thumbs-up"></span> Uw betaling is gelukt!</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4><strong>Hartelijk dank voor uw bestelling!</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="text-left">De door u bestelde producten zullen wij zo snel als mogelijk naar het door u gekozen adres versturen.</h4>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-5">
                            </div>
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-3">
                                <button type="submit" class="btn btn-success btn-block" name="ReturnHome">
                                    <span class="glyphicon glyphicon-ok"></span> Terug naar de hoofdpagina
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

