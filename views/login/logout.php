<?php
include 'loader.php';
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

unset($_SESSION['authenticated']);
unset($_SESSION['USER']);
echo display_message('success','U bent succesvol uitgelogd.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";