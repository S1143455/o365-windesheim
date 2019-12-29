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

// Update the people table
$updatePeople=$pushthedata->UpdateStmt('UPDATE people SET  
FullName="' . $_POST['FullName']	. '" ,
DateOfBirth= "' .date('Y-m-d',strtotime($_POST['DateOfBirth'])) .  '"
WHERE PersonId="'  . $_POST['PersonID'] . '"');

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

if ($savetheaddress+$savethecustomer+$updatePeople !=0) {
    // We also need to update the userdata in the $_SESSION array
    // Place the userdata (an array) into the $_SESSION
    $_SESSION['USER']['DATA'] = $pushthedata->selectStmt('select * from people WHERE PersonId="'  . $_POST['PersonID'] . '"');
    // The rest of the userdata.
    include 'content/frontend/GetUserDetails.php';
    echo display_message('success', 'Uw gegevens zijn aangepast.') . "<meta http-equiv='refresh' content='3'>";
}