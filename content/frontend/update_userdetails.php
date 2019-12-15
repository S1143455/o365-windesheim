<?php
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
$savethecustomer=$pushthedata->UpdateStmt("UPDATE customer SET 
Gender=\"" . $_POST['Gender']	. "\" ,
newsletter=\"" . $_POST['newsletter']	. "\" 
WHERE CustomerID ='" . $_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'] . "'");

if ($savetheaddress+$savethecustomer !=0){ echo "
<div class=\"alert alert-success\" role=\"alert\">
  <h4 class=\"alert-heading\">Uw gegevens zijn aangepast.</h4>
</div>
<meta http-equiv='refresh' content='2'>";}