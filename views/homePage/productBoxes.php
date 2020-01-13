<?php
//get products based on category, or all products if no category is chosen
if(!$cat_srch){
    $products = $product->retrieve();
}else {
    $products = $product->where('*', 'CategoryID', '=', $cat_parent->getCategoryID());
}

$one = false;

foreach($products as $prod){

    //check prod_counter for navigation to determine products to show on chosen page
    if($i < $prod_counter || $i > $prod_counter + $productsPerPage){
        $i++;
        continue;
    }

    //if there ain't a description, don't show product
    if($prod->getStockItemName() == ''){
        continue;
    }

    $one = true;
    echo '<div class="col-md-4 padding-bottom1em">';
        echo '<div class="productbox">';

            echo '<div class="imagebox">';

            $j = 1;
            $productAttachments = $fileController->retrieveWhereStockitemBackwards($prod->getStockItemID());
            foreach($productAttachments as $prodAtt){

                //only show first attachment
                If($j==1){
                    $this->showAttachment($prodAtt->getAttachmentID(), false,'img-responsive img-fit');
                }
                $j++;
            }

            echo '</div>';

            echo '<div class="productDetail">';
                echo '<form method="post" action="' . $this->root . '/productdetail">';
                echo '<input type="text" name="home" style="display:none;" value="' . (($cat_srch) ? false : true) . '">';
                echo '<input type="text" name="productID" style="display:none;" value="' . $prod->getStockItemID() . '">';

                $stockDescr = $prod->getStockItemName();
                if(strlen($prod->getStockItemName()) > 30){
                    $stockDescr = substr($prod->getStockItemName(),0,30) . '...';
                }

                echo '<b>' . $stockDescr . '</b><br>';
                echo '€' . $prod->getRecommendedRetailPrice() . '<br><br>';
                echo '<button name="srchProduct" type="submit" value="search product" class="productButton">';
                echo 'Bekijken >';
                echo '</button>';
                echo '<br>';
                echo '</form>';
            echo '</div>';

        echo '</div>';
    echo '</div>';
    $i++;
}
if (!$one){
    echo '<div class="textCenter">Geen producten gevonden.</div>';
}
?>