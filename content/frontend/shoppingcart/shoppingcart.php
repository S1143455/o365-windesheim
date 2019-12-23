<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';
// Set an array to redirect to the right PHP file.
$cartRedirect=[
    'winkerwagenbekijken'=> 'viewshoppingcart',
    'winkerwagenafrekenen' => 'paycart',
    'winkelwagenleegmaken' => 'emptycart'

];

if (!isset($_SESSION['authenticated']))
{
    echo display_message('info','Om te kunnen bestellen moet u ingelogd zijn.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/login\">";
    die;
}

include "content/frontend/shoppingcart/" . $cartRedirect[$_GET['page']] . ".php";