<?php

/**
 * PHPStorm doesnt recognize the variables after the include.
 * If you tell PHPStorm what type a variable is here, you can still use the type shortcuts.
 * @var $products array
 * @var $product Model\Product
 * @var $categories array(Model\Category)
 * @var $category Model\Category
 */
//print_R($products);

foreach ($products as $product)
{
    echo $product->getStockItemID();
    $product->getRelation("Category");
}


//foreach ($categories as $category)
//{
//}

/**
 * @param $table
 */
function test($table)
{
}




