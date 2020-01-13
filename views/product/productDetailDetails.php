<?php

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