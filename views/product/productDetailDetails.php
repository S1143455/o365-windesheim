<?php

//productdetails
echo '<div class="productDetails padding-top1em">';
    echo '<h2>' . $prod->getStockItemName() . '</h2><br>';
    echo '<h4>Productbeschrijving</h4>';

    If($prod->getStockItemDescription()==''){
        echo 'Geen productbeschrijving beschikbaar.';
    }else{
        echo $prod->getStockItemDescription();
    };
    echo '<br><br>';
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