<?php
include 'loader.php';
include_once 'content/frontend/header.php';
?>
<form method="post" action="">
    <div class="col-sm-1"><button type="submit" name="details" class="button" style="padding: 5px">details</button></div>
    <div class="col-sm-1"><button type="submit" name="orders" class="button" style="padding: 5px">orders</button></div>
</form>
<?php
if (!isset($_SESSION['authenticated']))
{
    Echo "U bent niet ingelogd. U wordt door gestuurd naar de hoofdpagina.";
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
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

