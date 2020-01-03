<?php

// A simple function to show a message.
function display_message($type, $message){
   return "<div class=\"alert alert-" . $type . "\" role=\"alert\"><h4 class=\"alert-heading\">" . $message . "</h4></div>";
}