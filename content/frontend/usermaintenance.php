<?php
include_once 'content/frontend/header.php';

// Check if the user is logged in. If not he will be redirected to the homepage.
if (!isset($_SESSION['authenticated']))
{
    Echo "<h2><b>U bent niet ingelogd.<br>U wordt door gestuurd naar de inlogpagina.</b></h2>";
    echo "<META HTTP-EQUIV=Refresh CONTENT=\";URL=/login\">";
}
// If the user is logged in we're going to the page he selected.
else
{
    if ($_GET['page']=='onderhoudaccount')
    {
        // Let's get the rest of the account details.
        $getthedata=new Model\Database();
        $sqlreturendsomething=$getthedata->selectStmt("SELECT * FROM customer WHERE PersonID = '". $_SESSION['USER']['DATA'][0]['PersonID'] . "'");
        $_SESSION['USER']['CUSTOMER_DETAILS']=$sqlreturendsomething;
        $sqlreturendsomething=$getthedata->selectStmt("SELECT * FROM address WHERE PersonID = '". $_SESSION['USER']['DATA'][0]['PersonID'] . "'");
        $_SESSION['USER']['ADDRESS']=$sqlreturendsomething;
        // Show the userdetails.
        include 'userdetails.php';
    }

    elseif ($_GET['page']=='onderhoudbestellingen')
    {
        include 'userorders.php';
    }
}

