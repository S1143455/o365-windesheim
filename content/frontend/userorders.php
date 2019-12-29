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

//echo "<pre>";print_r( $_SESSION['USER']['ORDER'][1]);echo "</pre><br>";
?>
<div class="container" style="width:100%">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="row" style="min-height: 50px;"></div>
            <div class="row">
                <form role="form" id="table" method="POST" action="">
                    <table id="categoryTable" class="table table-fixed">
                        <thead>
                            <tr>
                                <th class="col-md-1 text-right">Bestelnummer</th>
                                <th class="col-md-1 text-center">Besteldatum</th>
                                <th class="col-md-1 text-right">Bedrag</th>
                                <th class="col-md-3 text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($_SESSION['USER']['ORDER'] as $key)
                        {
                            echo '<tr>
                            <td class="col-md-1 text-right">' . $key['ORDER_DETAILS']['OrderID'] .'</td>
                            <td class="col-md-1 text-center">' . date( 'd-m-Y',strtotime($key['ORDER_DETAILS']['OrderDate'] )).'</td>
                            <td class="col-md-1 text-right">' . number_format($key['ORDER_DETAILS']['TOTALORDERPRICE'], 2, ',', '.')  .'</td>
                             <td class="col-md-3 text-right"><button type="submit" class="btn btn-success btn-block" name="viewdetails" value="' . $key['ORDER_DETAILS']['OrderID']  . '">
                                    Details <span class="glyphicon glyphicon-arrow-right"></span>
                                </button></td></tr>
                            ';
                        }
                        ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

