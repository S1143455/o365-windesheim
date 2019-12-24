<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

if (!isset($_SESSION['authenticated']))
{
    echo display_message('info','Om te kunnen bestellen moet u ingelogd zijn.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/login\">";
    die;
}

// Check if the users wants to pay.
if (isset($_POST['paycart'])){include 'content/frontend/shoppingcart/paycart.php';}
else include 'content/frontend/shoppingcart/viewshoppingcart.php';