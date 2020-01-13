<?php

if (isset($_POST['remove'])){
    $updateCart=$cart->RemoveItem($_POST['remove'],1);
}
?>