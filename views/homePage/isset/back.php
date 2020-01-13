<?php

//category previous
if(isset($_POST['back'])){
    $cat_to_srch = $category->retrieve($_POST['categoryID'])->getParentCategory();
    if ($cat_to_srch != ''){
        $cat_srch = true;
    }
    $prod_counter = 1;
}?>