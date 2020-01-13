<?php
include 'loader.php';
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

session_unset();
echo display_message('success','U bent succesvol uitgelogd.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/" . getenv('ROOT') . "\">";