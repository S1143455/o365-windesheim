<?php

//back from productDetail
if(isset($_POST['prdBack']) && (!$_POST['home'])){
    $cat_srch = true;
    $cat_to_srch = $_POST['categoryID'];
    $prod_counter = 1;
}?>