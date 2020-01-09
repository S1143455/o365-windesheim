<?php
include 'loader.php';
// The users is logged in.
use Model\ShoppingcartStockitems;
$handelData=new \Model\Database();
$cart=new \Model\ShoppingCart();

// Let's see if there are any items in the cart.
if (!$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']) {
    echo display_message('info','Uw winkelwagen bevat nog geen producten.');
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
    die;
}
$cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
//$anyItemsInCart=$shoppingcartStockitems->where("ShoppingCartID",$cartId);

// Check if the users wants to empty the card.
if (isset($_POST['emptycart']))
{
    $cleanCart=$cart->EmptyCart();
    if ($cleanCart==1){echo display_message('success','Uw winkelwagen is met succes verwijderd.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";die;}
    else {echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/\">";}
}
// if the $_POST isset we add or remove an item.
if (isset($_POST['add']))
{
    $updateCart=$cart->AddItem($_POST['add'],1);
    if ($updateCart==1){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";}
    else {echo display_message('info','Helaas is dit product niet meer op voorraad.'). "<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";}
}
if (isset($_POST['remove'])){
    $updateCart=$cart->RemoveItem($_POST['remove'],1);
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";
}
// Validate a discount code.
if (isset($_POST['FindDiscount'])){include 'content/frontend/shoppingcart/checkdiscount.php';}
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
                                    <h4><span class="glyphicon glyphicon-shopping-cart"></span> Uw winkelwagen</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php $getAllTheProducts=new \Model\Database();
                        $totalCartPrice=0;
                        $allTheProducts=$getAllTheProducts->selectStmt("select sti.StockItemID, sti.StockItemName,sti.MarketingComments, cit.StockItemAmount, sti.RecommendedRetailPrice, sti.Photo,(cit.StockItemAmount*sti.RecommendedRetailPrice) as CartPrice 
                                                                         from shoppingcart_stockitems cit left join stockitem sti on sti.StockItemID = cit.StockItemID where cit.ShoppingCartID=". $cartId .";");
                        foreach ($allTheProducts as $item)
                        {
                            $myItemRow='';
                            $myItemRow.='
                            <div class="row">
                                <div class="col-xs-2"><img class="img-responsive" src="' . $item['Photo'] .'"></div>
                                <div class="col-xs-6">
                                    <h4 class="product-name"><strong>' . $item['StockItemName'] .'</strong></h4><h4><small>' . $item['MarketingComments'] .'</small></h4>
                                </div>
                                <div class="col-xs-4">
                                    <div class="col-xs-2 text-right">
                                        <h6><strong>' . number_format($item['RecommendedRetailPrice'], 2, ',', '.') .'</strong></h6>
                                    </div>                                    
                                    <div class="col-xs-4">
                                        <span>
                                            <button type="submit" class="btn-sm btn-danger btn-block" name="remove" value="' . $item['StockItemID'].'"><span class="glyphicon glyphicon-minus"></button>
                                        </span>
                                     </div>
                                     <div class="col-xs-1">
                                        <h4 class="justify-content-center"><strong>' . $item['StockItemAmount'] .'</strong></h4>
                                     </div>
                                     <div class="col-xs-4">
                                        <span>
                                            <button type="submit" class="btn-sm btn-success btn-block input-group-prepend" name="add" value="' . $item['StockItemID'].'"><span class="glyphicon glyphicon-plus"></span></button>
                                        </span>
                                     </div>
                                </div>
                            </div>
                            <hr>';
                            $totalCartPrice=$totalCartPrice+$item['CartPrice'];
                            echo $myItemRow;
                        }
                        // create a SESSION array with the cart items
                        $_SESSION['USER']['SHOPPING_CART']['ITEMS']=$allTheProducts;
                        $_SESSION['USER']['SHOPPING_CART']['TOTAL_SUM']=$totalCartPrice;
                        ?>
                        <div class="row">
                            <div class="text-center">
                                <div class="col-xs-12">
                                    <h4 class="text-right">Subtotaal <strong><?php echo number_format($totalCartPrice, 2, ',', '.'); ?></strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center">
                                <div class="col-xs-3">
                                    <input type="text" class="form-control input-sm" placeholder="Kortingscode" name="DiscountCode" value="<?php if(isset($_SESSION['USER']['SHOPPING_CART']['DISCOUNT']))
                                    {
                                        echo $percentage=$_SESSION['USER']['SHOPPING_CART']['DISCOUNT']['DealCode'];
                                    }  ?>">
                                </div>
                                <div class="col-xs-3">
                                    <button type="submit" class="btn-sm btn-primary btn-block input-group-prepend" name="FindDiscount" value="FindDiscount"><span class="glyphicon glyphicon-search"></span><strong> Zoek code</strong></button>
                                </div>
                                <div class="col-xs-6">
                                    <h4 class="text-right">
                                        <?php if(isset($_SESSION['USER']['SHOPPING_CART']['DISCOUNT']))
                                        {
                                            echo "Uw Korting is " . number_format($percentage=$_SESSION['USER']['SHOPPING_CART']['DISCOUNT']['DiscountPercentage'], 2, ',', '.')." %";
                                        }
                                        ?><strong>
                                            <?php if(isset($_SESSION['USER']['SHOPPING_CART']['DISCOUNT']))
                                            {
                                                $percentage=$_SESSION['USER']['SHOPPING_CART']['DISCOUNT']['DiscountPercentage'];
                                                $sumOfDiscount=(($totalCartPrice/100)*$percentage);
                                                $newTotalCartPrice=$totalCartPrice-$sumOfDiscount;
                                                echo number_format($sumOfDiscount, 2, ',', '.');
                                            }
                                            ?></strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center">
                                <div class="col-xs-12">
                                    <h4 class="text-right">Totaal <strong><?php if(!isset($_SESSION['USER']['SHOPPING_CART']['DISCOUNT']))
                                            {
                                                echo number_format($totalCartPrice, 2, ',', '.');
                                                $_SESSION['USER']['SHOPPING_CART']['AMOUNT_TO_PAY']=number_format($totalCartPrice, 2, ',', '.');
                                            }
                                            else
                                            {
                                                echo number_format($newTotalCartPrice, 2, ',', '.');
                                                $_SESSION['USER']['SHOPPING_CART']['AMOUNT_TO_PAY']=number_format($newTotalCartPrice, 2, ',', '.');
                                            }
                                            ?></strong></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-success btn-block" name="backtomainpage">
                                    <span class="glyphicon glyphicon-arrow-left"></span> Terug naar hoofdpagina
                                </button>
                            </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-danger btn-block" name="emptycart">
                                    <span class="glyphicon glyphicon-trash"></span> Leegmaken
                                </button>
                            </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-success btn-block" name="checkaddress">
                                    Adres controleren <span class="glyphicon glyphicon-arrow-right"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>