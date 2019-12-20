<?php
// Let's see if we can find the emailaddress of the user.
echo "Let get this show on the road...<br>";
print_r($_POST);


// here we need some code to send the emailaddress to the user.


// It does not matter if the emailaddress was found or not.
// The message below will be shown.
echo "
<div class=\"alert alert-success\" role=\"alert\">
  <h4 class=\"alert-heading\">Als uw emailadres is gevonden, dan is uw wachtwoord verstuurd naar uw adres.<br>Controleer ook uw spambox.</h4>
</div>
<meta http-equiv='refresh' content='35'>";