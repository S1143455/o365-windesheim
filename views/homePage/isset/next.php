<?php
//next set of products

if(isset($_POST['next'])){
    $cat_to_srch = $_POST['categoryID'];

    if($cat_to_srch != '') {
        $cat_srch = true;
    }
    $prod_counter = $_POST['prodCounter'] + $productsPerPage;
}?>