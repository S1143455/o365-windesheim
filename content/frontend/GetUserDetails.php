<?php
$getthedata=new Model\Database();
// Let's get the rest of the account details.
$customerDetails=$getthedata->selectStmt("SELECT * FROM customer WHERE PersonID = '". $_SESSION['USER']['DATA'][0]['PersonID'] . "'");
$_SESSION['USER']['CUSTOMER_DETAILS']=$customerDetails;
// The address details.
$addressDetails=$getthedata->selectStmt("SELECT * FROM address WHERE PersonID = '". $_SESSION['USER']['DATA'][0]['PersonID'] . "'");
$_SESSION['USER']['ADDRESS']=$addressDetails;
