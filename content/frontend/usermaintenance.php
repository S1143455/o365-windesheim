<?php
include 'loader.php';
include_once 'content/frontend/header.php';
?>
<form method="post" action="">
    <div class="col-sm-1"><button type="submit" name="details" class="button" style="padding: 5px">details</button></div>
    <div class="col-sm-1"><button type="submit" name="orders" class="button" style="padding: 5px">orders</button></div>
</form>
<?php
// Check if the user is logged in. If not he will be redirected to the homepage.
if (!isset($_SESSION['authenticated']))
{
    Echo "U bent niet ingelogd. U wordt door gestuurd naar de hoofdpagina.";
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
}
// If the user is logged in, remaining user data will be fetched out of the DB.
else
{
    $getthedata=new Model\Database();
    $sqlreturendsomething=$getthedata->selectStmt("SELECT * FROM customer WHERE PersonID = '". $_SESSION['USER']['DATA'][0]['PersonID'] . "'");
    $_SESSION['USER']['CUSTOMER_DETAILS']=$sqlreturendsomething;
    $sqlreturendsomething=$getthedata->selectStmt("SELECT * FROM address WHERE PersonID = '". $_SESSION['USER']['DATA'][0]['PersonID'] . "'");
    $_SESSION['USER']['ADDRESS']=$sqlreturendsomething;
}


if (!isset($_POST['orders']))
{
    include 'userdetails.php';
}
else
{
    include 'userorders.php';
}
?>

