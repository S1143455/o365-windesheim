<?php
include 'loader.php';
include_once 'content/frontend/header.php';

if(isset($_POST['logout']))
{
    unset($_SESSION['authenticated']);
    unset($_SESSION['USER']);
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/\">";
}
?>

<form method="post" action="">
    <button type="submit" name="logout">Uitloggen</button>
</form>