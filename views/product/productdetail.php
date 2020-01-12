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

?>
    <div>
            <?php
                echo '<form method="post" action="'. getenv("ROOT") . '" class="padding-top1em">';
                echo '<input type="text" name="home" style="display:none;" value="' . $_POST['home'] . '">';
                echo '<input type="text" name="categoryID" style="display:none;" value="' . $prod->getCategoryID() . '">';
                echo '<button name="prdBack" type="submit">Terug</button>';
                echo '</form>';
            ?>
    </div>

    <div class="row padding-top1em">
        <div id = "product" class="productContainer">
            <?php
            echo '<div class="prodImgContainer">';
                echo '<div class="prodImg">';
                    echo '<div class="imgLeft">';
                    echo '</div>';

                    $main->showAttachment($prod->getAttachmentID(), true, 'productDetailIMG');

                    echo '<div class="imgRight">';
                    echo '</div>';
                echo'</div>';
            echo'</div>';

            echo '<div class="productDetails padding-top1em   ">';
                echo '<h2>' . $prod->getStockItemName() . '</h2><br>';
                echo '<h4>Productbeschrijving</h4>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

                echo '<div class="prdPrice"><h4>Prijs</h4>';
                    echo '<h2>€' . $prod->getRecommendedRetailPrice() . '</h2>';

                    echo '<form role="form" id="table" method="POST" action="' . getenv('ROOT') . '/productdetail">';

                    //values navigation through back-button
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
//include 'content/frontend/itemlist.php';
include_once 'content/frontend/footer.php';

?>