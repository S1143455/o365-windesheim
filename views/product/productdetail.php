<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

//in ProductController geimporteerd : $cart=new \Model\ShoppingCart();
// if the $_POST isset we add the item to the cart.
if (isset($_POST['add']))
{
    $updateCart=$cart->AddItem($_POST['add'],1);
    //if ($updateCart==1){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";}
    if ($updateCart!=1){echo display_message('info','Helaas is dit product niet meer op voorraad.');}
}

if (isset($_POST['remove'])){
    $updateCart=$cart->RemoveItem($_POST['remove'],1);
}

$imgCounter = 0;
$imgMAX = 2;
if(isset($_POST['imgBack'])){
    $imgCounter = $_POST['imgCounter'] -1;
}

if(isset($_POST['imgForward'])){
    $imgCounter = $_POST['imgCounter'] +1;
}
?>
    <div class="container">
            <?php

                //backbutton
                echo '<form method="post" action="'. getenv("ROOT") . '" class="padding-top1em">';

                    //pass values navigation through back-button
                    echo '<input type="text" name="home" style="display:none;" value="' . $_POST['home'] . '">';
                    echo '<input type="text" name="categoryID" style="display:none;" value="' . $prod->getCategoryID() . '">';

                    echo '<button name="prdBack" type="submit" class="normalButton">< Terug</button>';
                echo '</form>';
            ?>
    </div>

    <div class="padding-top1em container">
        <div id = "product" class="productContainer">
            <?php

            //productImage
            echo '<div class="prodImgContainer">';
                    echo '<form method = "post" action = "'.getenv("ROOT") . '/productdetail">' ;

                        //pass values navigation through back-button
                        echo '<input type="text" name="home" style="display:none;" value="' . $_POST['home'] . '">';
                        echo '<input type="text" name="categoryID" style="display:none;" value="' . $prod->getCategoryID() . '">';
                        echo '<input type="text" name="productID" style="display:none;" value="' . $prod->getStockItemID() . '">';
                        echo '<input type="text" name="imgCounter" style="display:none;" value="' . $imgCounter . '">';

                        echo '<button name="imgBack" type = "submit" class="noButton">';

                        if($imgCounter == 0) {
                            echo '<div class="imgLeft noPointer">';
                        }else{
                            echo '<div class="imgLeft">';
                        }
                        echo '</div>';
                        echo '</button>';

                        echo '<div class="prodImg">';

                            $main->showAttachment($prod->getAttachmentID(), true, 'productDetailIMG');

                        echo'</div>';

                        echo '<button name="imgForward" type = "submit" class="noButton">';

                        if($imgCounter == $imgMAX) {
                            echo '<div class="imgRight noPointer">';
                        }else{
                            echo '<div class="imgRight">';
                        }
                        echo '</div>';
                        echo '</button>';
                    echo '</form>';
            echo'</div>';

            //productdetails
            echo '<div class="productDetails padding-top1em">';
                echo '<h2>' . $prod->getStockItemName() . '</h2><br>';
                echo '<h4>Productbeschrijving</h4>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

                echo '<div class="prdPrice"><h4>Prijs</h4>';
                    echo '<h2>€' . $prod->getRecommendedRetailPrice() . '</h2>';

                    echo '<form role="form" id="table" method="POST" action="' . getenv('ROOT') . '/productdetail">';

                        //pass values navigation through back-button
                        echo '<input type="text" name="home" style="display:none;" value="' . $_POST['home'] . '">';
                        echo '<input type="text" name="categoryID" style="display:none;" value="' . $prod->getCategoryID() . '">';

                        echo '<input type = "text" name = "productID" style = "display:none;" value = "'. $prod->getStockItemID() . '">';
                        echo '<td class="col-md-2"><button type="submit" name="add" value="' . $prod->getStockItemID() . '">Toevoegen aan winkelwagen</button></td>';

                    echo '</form>';
                echo '</div>';
            echo '</div>';
            ?>
        </div>
    </div>
<?php
include_once 'content/frontend/footer.php';

?>