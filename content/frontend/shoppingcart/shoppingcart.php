<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

if (!isset($_SESSION['authenticated']))
{
    echo display_message('info','Om te kunnen bestellen moet u ingelogd zijn.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/login\">";
    die;
}

if (isset($_SESSION['USER']['SHOPPING_CART']['PAYMENT']))
{

    if($_SESSION['USER']['SHOPPING_CART']['PAYMENT']=='retry')
    {
        unset($_SESSION['USER']['SHOPPING_CART']['PAYMENT']);
        include 'content/frontend/shoppingcart/handlepayment.php'; die;
    }

    if($_SESSION['USER']['SHOPPING_CART']['PAYMENT']=='method')
    {
        unset($_SESSION['USER']['SHOPPING_CART']['PAYMENT']);
        include 'content/frontend/shoppingcart/paycart.php'; die;
    }


}

// Check what the users wants to do.
if (isset($_POST['backtomainpage'])){ echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/\">";}
if (isset($_POST['checkaddress'])){include 'content/frontend/shoppingcart/checkaddress.php'; die;}
if (isset($_POST['paycart'])){include 'content/frontend/shoppingcart/paycart.php';die;}
if (isset($_POST['paymentmethod'])){include 'content/frontend/shoppingcart/handlepayment.php'; die;}

else include 'content/frontend/shoppingcart/viewshoppingcart.php';