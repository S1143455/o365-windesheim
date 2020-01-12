<?php
include 'loader.php';
// The users is logged in.
use Model\ShoppingcartStockitems;
$handelData=new \Model\Database();
$cart=new \Model\ShoppingCart();

// Let's see if there are any items in the cart.
if (!$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']) {
    echo display_message('info','Uw winkelwagen bevat nog geen producten.');
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/" . getenv('ROOT') . "\">";
    die;
}
$cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
//$anyItemsInCart=$shoppingcartStockitems->where("ShoppingCartID",$cartId);

// Check if the users wants to empty the card.
if (isset($_POST['emptycart']))
{
    $cleanCart=$cart->EmptyCart();
    if ($cleanCart==1){echo display_message('success','Uw winkelwagen is met succes verwijderd.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/" . getenv('ROOT') . "\">";die;}
    else {echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/" . getenv('ROOT') . "\">";}
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
<head><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"></head>
<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="" style="width:100%">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><i class="fas fa-shopping-cart"></i> Uw winkelwagen</h4>
                                    <hr>
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
                                <div class="col-md-2"><img class="img-responsive" src="' . $item['Photo'] .'"></div>
                                <div class="col-md-6">
                                    <h4 class="product-name"><strong>' . $item['StockItemName'] .'</strong></h4><h4><small>' . $item['MarketingComments'] .'</small></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6><strong>' . number_format($item['RecommendedRetailPrice'], 2, ',', '.') .'</strong></h6>
                                        </div> 
                                        <div class="col-md-8">
                                            <row>
                                                <div class="col-xs-4">
                                                    <button type="submit" class="btn-sm btn-success btn-block" name="add" value="' . $item['StockItemID'].'"><i class="fas fa-plus"></i></button>
                                                </div>
                                                 <div class="col-xs-1">
                                                    <h4><strong>' . $item['StockItemAmount'] .'</strong></h4>
                                                 </div>
                                                 <div class="col-xs-4">
                                                    <button type="submit" class="btn-sm btn-danger btn-block" name="remove" value="' . $item['StockItemID'].'"><i class="fas fa-minus"></i></button>
                                                 </div>
                                            </row>
                                        </div>
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
                            <div class="col-md-12">
                                <h4 class="text-right">Subtotaal <strong><?php echo number_format($totalCartPrice, 2, ',', '.'); ?></strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control input-sm" placeholder="Kortingscode" name="DiscountCode" value="<?php if(isset($_SESSION['USER']['SHOPPING_CART']['DISCOUNT']))
                                {
                                    echo $percentage=$_SESSION['USER']['SHOPPING_CART']['DISCOUNT']['DealCode'];
                                }  ?>">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn-sm btn-primary btn-block input-group-prepend" name="FindDiscount" value="FindDiscount"><strong> Zoek code</strong> <i class="fas fa-search"></i></button>
                            </div>
                            <div class="col-md-6">
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
                        <div class="row">
                            <div class="col-md-12">
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
                    <hr>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-block" name="backtomainpage">
                                    <i class="fas fa-arrow-circle-left"></i> Terug naar hoofdpagina
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-danger btn-block" name="emptycart">
                                    <i class="far fa-trash-alt"></i> Leegmaken
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-block" name="checkaddress">
                                    Adres controleren <i class="fas fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>