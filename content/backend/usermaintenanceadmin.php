<?php
include_once 'content/backend/header-admin.php';

// Check if the user is logged in. If not he will be redirected to the homepage.
if (!isset($_SESSION['authenticated']))
{
    Echo "<h2><b>U bent niet ingelogd.<br>U wordt door gestuurd naar de inlogpagina.</b></h2>";
    echo "<META HTTP-EQUIV=Refresh CONTENT=\";URL=/admin/login\">";
}
// If the user is logged in we're going to the page he selected.
else
{
    if ($_GET['page']=='onderhoudaccount')
    {
        include 'userdetails.php';
    }

    elseif ($_GET['page']=='onderhoudbestellingen')
    {
        include 'userorders.php';
    }
}

