<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';
// Set an array to redirect to the right PHP file.
$cartRedirect=[
    'winkerwagenbekijken'=> 'viewshoppingcart',
    'winkerwagenafrekenen' => 'paycart',
    'winkelwagenleegmaken' => 'emptycart'

];

echo "this is going to be a shoppingcart<br>";
echo "POST  : ";print_r($_POST);echo "<br>";
echo "GET   : ";print_r($_GET);echo "<br>";
echo "CART  : ";print_r($cartRedirect);echo "<br>";

include "content/frontend/shoppingcart/". $cartRedirect[$_GET['page']] . ".php";
