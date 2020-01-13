<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

$pathProdutDetails = 'views/product/isset/';
$imgCounter = 0;
$imgMAX = 2;

include_once($pathProdutDetails . 'add.php');
include_once($pathProdutDetails . 'remove.php');
include_once($pathProdutDetails . 'imgBack.php');
include_once($pathProdutDetails . 'imgForward.php');
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
            <div class="prodImgContainer">
            <?php include_once('productImage.php'); ?>
            </div>
            <?php include_once('productDetailDetails.php');?>
        </div>
    </div>
<?php
include_once 'content/frontend/footer.php';

?>