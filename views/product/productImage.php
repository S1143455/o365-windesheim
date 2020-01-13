<?php
    echo '<form method = "post" action = "'.getenv("ROOT") . '/productdetail">' ;

    //pass values navigation through back-button
    echo '<input type="text" name="home" style="display:none;" value="' . $_POST['home'] . '">';
    echo '<input type="text" name="categoryID" style="display:none;" value="' . $prod->getCategoryID() . '">';
    echo '<input type="text" name="productID" style="display:none;" value="' . $prod->getStockItemID() . '">';
    echo '<input type="text" name="imgCounter" style="display:none;" value="' . $imgCounter . '">';

    echo '<button name="imgBack" type = "submit" class="noButton">';

        if($imgCounter == 1) {
            echo '<div class="imgLeft noPointer">';
        }else{
            echo '<div class="imgLeft">';
        }
        echo '</div>';
    echo '</button>';

        echo '<div class="prodImg">';

        $j = 1;
        foreach($productAttachments as $prodAtt) {
            if($imgCounter==$j) {
                $main->showAttachment($prodAtt->getAttachmentID(), true, 'productDetailIMG');
            }
            $j++;
        }

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
?>
