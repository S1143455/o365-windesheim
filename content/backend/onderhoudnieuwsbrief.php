<?php
include_once 'content/backend/header-admin.php';
//include_once 'content/backend/sidebar-admin.php';
include 'content/frontend/display_message.php';
//include_once 'content/backend/footer-admin.php';

// Check if the newsletter should be saved.
if (isset($_POST['saveNewsletter']))
{
    include  'content/backend/newsletter/saveNewsltr.php';
    echo display_message('success','De nieuwsbrief is opgeslagen.'). "<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";
}

// Check if the newsletter should be saved and send.
if (isset($_POST['sendNewsletter']))
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
if (isset($_POST['CreateNewsletter'])){include 'content/backend/newsletter/newsltrMainBody.php';}
elseif (isset($_POST['ChangeNewsletter'])){include 'content/backend/newsletter/newsltrMainBody.php';}
else include 'content/backend/newsletter/mainnewsltr.php';
