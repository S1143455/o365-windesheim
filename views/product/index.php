<?php
echo "Index page";


echo '<br>Using $products as variable gives a error in PHPStorm<br>';
foreach ($products as $product)
{
    echo $product->getStockItemID();
}
echo '<br>using $this-> doenst throw an error in PHPStorm<br>';
foreach ($this->products as $product)
{
    echo $product->getStockItemID();
}



