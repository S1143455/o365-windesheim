<?php
// Handle the payments.
$paymentmethod=$_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD'];

// The easiest payment is Afterpay. This payment will always result in a success.
if ($paymentmethod=='afterpay'){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/betalengelukt\">";}
else {echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/betalenmislukt\">";}


