<?php
include_once 'content/frontend/display_message.php';
// Update Address
$pushthedata=new Model\Database();
$savetheaddress=$pushthedata->UpdateStmt("UPDATE address SET 
Address=\"" . $_POST['Address']	. "\" ,
Zipcode='" . $_POST['Zipcode'] . "' ,
City= \"" . $_POST['City']. "\" ,
LastEditedBy='" . $_POST['PersonID'] . "'
WHERE AddressId = '" . $_POST['AddressId'] . "' 
and PersonId='" . $_POST['PersonID'] . "'");

// Update the customer
if (isset($_POST['newsletter']))
    $newsletter=1;
else
    $newsletter=0;

if ($_POST['Gender']=='male')
    $gender='Man';
else
    $gender='Vrouw';

$savethecustomer=$pushthedata->UpdateStmt("UPDATE customer SET 
Gender=\"" . $gender	. "\" ,
newsletter=\"" . $newsletter . "\" 
WHERE CustomerID ='" . $_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'] . "'");

if ($savetheaddress+$savethecustomer !=0)
    echo display_message('success', 'Uw gegevens zijn aangepast.') . "<meta http-equiv='refresh' content='3'>";