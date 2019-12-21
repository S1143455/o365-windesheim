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

//foreach ($products as $product)
//{
//    echo $product->getStockItemID();
//    echo $product->getCategoryID();
//    $product->getRelation("Category");
//}


foreach ($categories as $category)
{
    echo "Category  :" . $category->getCategoryName() . "<br>";
    $products = $category->getRelation('Product');
    foreach($products as $product)
    {
        echo $product->getStockItemName();
        echo $product->getStockItemID() . "<br>";
    }
}

/**
 * @param $table
 */
function test($table)
{
}




