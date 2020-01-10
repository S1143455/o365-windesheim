<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

// Check if the user is logged in. If not he will be redirected to the homepage.
if (!isset($_SESSION['authenticated']))
{
    echo display_message('danger','U bent niet ingelogd.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/" . getenv('ROOT') . "login\">";;
}

// If the user is logged in we're going to the page he selected.
else
{
    if ($_GET['page']=='onderhoudaccount')
    {
        // Show the userdetails.
        include 'userdetails.php';
    }

    elseif ($_GET['page']=='onderhoudbestellingen')
    {
        include 'userorders.php';
    }
}

