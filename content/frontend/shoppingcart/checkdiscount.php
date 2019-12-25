<?php
// A simple function to delete the discount elements.
function CleanElements(){
    if (isset($_SESSION['USER']['SHOPPING_CART']['DISCOUNT']))
    {
        unset($_SESSION['USER']['SHOPPING_CART']['DISCOUNT']);
    }
}

// Has the user entered a code?
if(empty($_POST['DiscountCode']))
{
    CleanElements();
    echo display_message('info','U heeft geen code ingevoerd.') ."<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";
    return;
}

// Check if there's a discount present in the SESSION array.
// It there is one. That one will be deleted.
CleanElements();

//Let check if the code can be found.
$givenCode=preg_replace("/[^a-zA-Z0-9]/", "", $_POST['DiscountCode']); // We'll use a clean code...
$handelData=new \Model\Database();
$foundCode=$handelData->selectStmt("select * from specialdeals where DealCode='". $givenCode ."' and Active=1");

// The code could'nt be found.
if (!$foundCode)
{
    echo display_message('info','U heeft geen juiste code ingevoerd.') ."<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";
    return;
}

// Check if the code is still valid.
$codeStartDate=strtotime($foundCode[0]['StartDate']);
$codeEndDate=strtotime($foundCode[0]['EndDate']);
$codeEnteredDate=time();
if (!(($codeEnteredDate >= $codeStartDate) && ($codeEnteredDate <= $codeEndDate)))
{
    echo display_message('info','De door u ingevoerde code is helaas verlopen.') ."<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";
    return;
}

// Let's put the found code in the SESSION array
$_SESSION['USER']['SHOPPING_CART']['DISCOUNT']=$foundCode[0];
