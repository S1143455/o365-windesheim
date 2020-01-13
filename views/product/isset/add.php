<?php

//in ProductController geimporteerd : $cart=new \Model\ShoppingCart();
// if the $_POST isset we add the item to the cart.
if (isset($_POST['add']))
{
    $updateCart=$cart->AddItem($_POST['add'],1);
    //if ($updateCart==1){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";}
    if ($updateCart!=1){echo display_message('info','Helaas is dit product niet meer op voorraad.');}
}
?>