<?php
include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';
include 'content/frontend/display_message.php';
//include_once 'content/backend/footer-admin.php';
//echo "**************<pre>";print_r($_POST); echo "</pre>**************<br>";
//if (isset($_POST['saveNewsletter'])){echo "post<br> **************<pre>";print_r($_POST); echo "</pre>get<br>**************<br><pre>";print_r($_GET); echo "</pre>**************<br>";}

// Check if the newsletter should be saved.
if (isset($_POST['saveNewNewsletter']))
{
    include  'content/backend/newsletter/saveNewsltr.php';
    echo display_message('success','De nieuwsbrief is opgeslagen.'). "<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";
    die;
}

// Check if the newsletter should be saved and send.
if (isset($_POST['sendNewNewsletter']))
{
    include  'content/backend/newsletter/saveNewsltr.php';
    echo display_message('success','De nieuwsbrief is opgeslagen en verzonden.'). "<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";
}

// Check if the newsletter is to be resend
if (isset($_POST['reSendNewNewsletter']))
{
    include  'content/backend/newsletter/resendNewsletter.php';
    echo display_message('success','De nieuwsbrief is opnieuw verzonden.'). "<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";
}

// cycle thru the menu items.
    if (isset($_POST['CreateNewsletter'])){include 'content/backend/newsletter/createnewsltr.php';}
elseif (isset($_POST['MaintainNewsletter'])){include 'content/backend/newsletter/maintainnewsltr.php';}
else include 'content/backend/newsletter/mainnewsltr.php';
