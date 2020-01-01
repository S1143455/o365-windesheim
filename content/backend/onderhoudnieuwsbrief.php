<?php
include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';
//include_once 'content/backend/footer-admin.php';
echo "**************<pre>";print_r($_POST); echo "</pre>**************<br>";

//if (isset($_POST['saveNewsletter'])){echo "post<br> **************<pre>";print_r($_POST); echo "</pre>get<br>**************<br><pre>";print_r($_GET); echo "</pre>**************<br>";}


    if (isset($_POST['CreateNewsletter'])){include 'content/backend/newsletter/createnewsltr.php';}
elseif (isset($_POST['MaintainNewsletter'])){include 'content/backend/newsletter/maintainnewsltr.php';}
else include 'content/backend/newsletter/mainnewsltr.php';
