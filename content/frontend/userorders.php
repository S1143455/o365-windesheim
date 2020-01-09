<?php
$handleDatabase=new \Model\Database();
$cart=new \Model\ShoppingCart();

$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
$personId=$_SESSION['USER']['DATA'][0]['PersonID'];

// let's find out if the user has any orders.
// If there are no order the user will be redirected to the mainpage.
$orders=$handleDatabase->selectStmt("select * from orders where customerId=".$customerId." order by OrderID desc");

if (!$orders)
{
    echo display_message('info','Uw heeft nog geen bestelling geplaatst. U wordt doorgestuurd naar de hoofdpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/" . getenv('ROOT') . "\">";
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
    $theOrdersDetails=$handleDatabase->selectStmt('select ost.*,sti.Photo,sti.StockItemName,sti.MarketingComments 
                                                        from order_stockitem ost left join StockItem sti on sti.StockItemID=ost.StockItemID where ost.orderid='.$orderkey['OrderID']);

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

// Check if the user has pressed a button
if (isset($_POST['add']))
{
    $updateCart=$cart->AddItem($_POST['add'],1);
    if ($updateCart==1){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";}
    else {echo display_message('info','Helaas is dit product niet meer op voorraad.'). "<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";}
}

if (isset($_POST['reorder']))
{
    $updateCart=$cart->ReOrder($_SESSION['USER']['ORDER'][$_POST['reorder']]['ORDER_DETAILS']['ORDER_ITEMS']);
    if ($updateCart==1){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";}
    else {echo display_message('info','Helaas was niet alles (voldoende) op voorraad.<br>Controleer uw bestelling voor u deze plaatst'). "<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";}
}

//echo "<pre>";print_r( $_SESSION['USER']['ORDER'][$_POST['reorder']]['ORDER_DETAILS']['ORDER_ITEMS']);echo "</pre><br>";
?>
<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4>Uw Bestellingen</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-left">
                                <div class="col-xs-2 text-right"><h4>Bestelnummer</h4></div>
                                <div class="col-xs-2 text-center"><h4>Besteldatum</h4></div>
                                <div class="col-xs-2 text-right"><h4>Bedrag</h4></div>
                                <div class="col-xs-6 text-center"></div>
                            </div>
                        </div>
                        <?php
                        foreach($_SESSION['USER']['ORDER'] as $key)
                        {
                        echo '<hr>
                        <div class="row">
                            <div class="text-center">
                                <div class="col-xs-2 text-right">' . $key['ORDER_DETAILS']['OrderID'] .'</div>
                                <div class="col-xs-2 text-center">' . date( 'd-m-Y',strtotime($key['ORDER_DETAILS']['OrderDate'] )).'</div>
                                <div class="col-xs-2 text-right">' . number_format($key['ORDER_DETAILS']['TOTALORDERPRICE'], 2, ',', '.')  .'</div>
                                <div class="col-xs-2 text-right">
                                    <button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#Details' . $key['ORDER_DETAILS']['OrderID']  . '" aria-expanded="false" aria-controls="collapse' . $key['ORDER_DETAILS']['OrderID']  . '">
                                    Details
                                    </button>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <button type="submit" class="btn btn-success btn-block" name="reorder" value="' . $key['ORDER_DETAILS']['OrderID'] .'">
                                        Bestelling opnieuw plaatsen
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="Details' . $key['ORDER_DETAILS']['OrderID']  . '"><br>
                            <div class="card card-body">
                                <div class="container">
                                    <div class="row">
                                        <form role="form" id="detailstable" method="POST" action="">
                                            <div class="col-xs-7">
                                                <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <div class="panel-title">
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <h4></span>Details van uw bestelling</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-body">';
                                                $countrows=0;
                                                foreach ($key['ORDER_DETAILS']['ORDER_ITEMS'] as $item)
                                                {
                                                    if ($countrows>0){echo "<hr>";}
                                                    echo '
                                                    <div class="row">
                                                        <div class="col-xs-2"><img class="img-responsive" src="' . $item['Photo'] .'"></div>
                                                        <div class="col-xs-4">
                                                            <h4 class="product-name"><strong>' . $item['StockItemName'] .'</strong></h4><h4><small>' . $item['MarketingComments'] .'</small></h4>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="col-xs-2 text-right">
                                                                <h6><strong>' . number_format($item['TotalCartPrice'], 2, ',', '.') .'</strong></h6>
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <h4 class="justify-content-center"><strong>' . $item['ItemAmount'] .'</strong></h4>
                                                            </div>
                                                            <div class="col-xs-7">
                                                                <span>
                                                                    <button type="submit" class="btn-sm btn-success btn-block input-group-prepend" name="add" value="'. $item['StockItemID'].'">
                                                                        Item opnieuw bestellen
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ';
                                                    $countrows++;
                                                }
                                                echo'</div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>