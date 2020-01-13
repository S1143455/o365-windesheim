<?php
//if category is searched, then load new category and categories belonging to searched category
if($cat_srch){
$cat_parent = $category->retrieve($cat_to_srch);
$categories = $category->where("*", "ParentCategory", "=", $cat_parent->getCategoryID());
}else{
$cat_parent = '';
$categories = $category->retrieve();
}

//reset product_counter
if ($prod_counter < 1){
$prod_counter = 1;
}
?>