<?php
$handleDatabase=new \Model\Database();
$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
$personId=$_SESSION['USER']['DATA'][0]['PersonID'];

// let's find out if the user has any orders.
// If there are no order the user will be redirected to the mainpage.
$orders=$handleDatabase->selectStmt("select * from orders where customerId=".$customerId);

if (!$orders)
{
    echo display_message('info','Uw heeft nog geen bestelling geplaatst. U wordt doorgestuurd naar de hoofdpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
}
// Clean the orderdetails.
$_SESSION['USER']['ORDER']=array();

// Place the orderdetails and the ordered items in the $_SESSION array;
foreach ($orders as $orderkey)
{
    $theOrders=$handleDatabase->selectStmt('select * from orders where orderid='.$orderkey['OrderID']);
    // Remove the numbered keys from the array
    foreach ($theOrders as $key => $value){foreach ($value as $newkey =>$newvalue){if (is_numeric ($newkey)) {unset($theOrders[0][$newkey]);}}}
    $_SESSION['USER']['ORDER'][$theOrders[0]['OrderID']]['ORDER_DETAILS']=$theOrders[0];

    // Add the order details
    $theOrdersDetails=$handleDatabase->selectStmt('select * from order_stockitem where orderid='.$orderkey['OrderID']);

    // Remove the numbered keys from the array
    foreach ($theOrdersDetails as $key => $value){foreach ($value as $newkey =>$newvalue){if (is_numeric ($newkey)){unset($theOrdersDetails[$key][$newkey]);}}}
    $_SESSION['USER']['ORDER'][$theOrders[0]['OrderID']]['ORDER_DETAILS']['ORDER_ITEMS']=$theOrdersDetails;

    // Get the total price and the total amount of the ordered items.
    $totalPrice=0;
    $noItems=0;
    foreach ($_SESSION['USER']['ORDER'][$theOrders[0]['OrderID']]['ORDER_DETAILS']['ORDER_ITEMS'] as $item) {
        $totalPrice=$totalPrice+$item['TotalCartPrice'];
        $noItems++;
    }
    $_SESSION['USER']['ORDER'][$orderkey['OrderID']]['ORDER_DETAILS']['TOTALORDERPRICE']=$totalPrice;
    $_SESSION['USER']['ORDER'][$orderkey['OrderID']]['ORDER_DETAILS']['NUMBEROFITEMS']=$noItems;
}

echo "<pre>";print_r( $_SESSION['USER']['ORDER']);echo "</pre><br>";
?>
<div class="container" style="width:100%">
    <div class="row">
        <div class="col-md-8">
            <div class="row" style="min-height: 50px;"></div>
            <div class="row">
                <form role="form" id="table" method="POST" action="">
                    <table id="categoryTable" class="table table-fixed">
                        <thead>
                            <tr>
                                <th class="col-md-1">manage</th>
                                <th class="col-md-2">Categorie ID</th>
                                <th class="col-md-5">Omschrijving</th>
                                <th class="col-md-2">Parent Categorie</th>
                                <th class="col-md-2">Acties </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

