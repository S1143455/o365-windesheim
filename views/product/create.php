<?php
if(isset($_POST['product']))
{
    include 'loader.php';
    $product = new Classes\Product();
    $product->create($_POST['product']);

    echo 'POST FOUND';
}

echo "Create page";