<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

// Check if if the users is logged in.
if (!isset($_SESSION['authenticated']))
{
    echo display_message('info','Om te kunnen bestellen moet u ingelogd zijn.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/" . getenv('ROOT') . "login\">";
    die;
}

// If the payment fail we need to handel that.
if (isset($_SESSION['USER']['SHOPPING_CART']['PAYMENT']))
{
    // The users wants to retry the payment with the same method.
    if($_SESSION['USER']['SHOPPING_CART']['PAYMENT']=='retry')
    {
        unset($_SESSION['USER']['SHOPPING_CART']['PAYMENT']);
        include 'content/frontend/shoppingcart/handlepayment.php'; die;
    }

    // The users wishes to change his payment method.
    if($_SESSION['USER']['SHOPPING_CART']['PAYMENT']=='method')
    {
        unset($_SESSION['USER']['SHOPPING_CART']['PAYMENT']);
        include 'content/frontend/shoppingcart/paycart.php'; die;
    }
}

// Check what the users wants to do.
if (isset($_POST['backtomainpage'])){ echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/" . getenv('ROOT') . "\">";}
if (isset($_POST['checkaddress'])){include 'content/frontend/shoppingcart/checkaddress.php'; die;}
if (isset($_POST['paycart'])){include 'content/frontend/shoppingcart/paycart.php';die;}
if (isset($_POST['paymentmethod'])){include 'content/frontend/shoppingcart/handlepayment.php'; die;}

else include 'content/frontend/shoppingcart/viewshoppingcart.php';