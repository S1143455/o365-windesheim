<?php
// Let's see if we can find the emailaddress of the user.
$getEmailAddress= new \Model\Database();
$emailAddress=$getEmailAddress->selectStmt("SELECT EmailAddress FROM people WHERE LogonName='" . $_POST['LogonName'] . "' AND EmailAddress='" . $_POST['EmailAddress'] . "'");

// If the combination of the username and the emailaddress was not found. The rest of the code will not be executed.
// The 'mail has been send' message will be shown.
//if (!$emailAddress){goto ShowTheMessage;}

// If the combination of the username and the emailaddress was found a mail will be send with a link to reset the password.
// The link will contain a random string and is valid for a set amount of minutes only.
// If the time expires the user will need to request a new link.

// First off : The function for the random string
function generateRandomString($length = 55) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%^*()_+=-<>';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$randomString=generateRandomString();

// Second : We need to set the 'valid until' time.
// To make teh calculation easy we will use the epoch time (UNIX timestamp)
$getValidMinutes= new \Model\User();
$validMinutes=$getValidMinutes->passwordRecoveryTime();
$validUntil=time() + $validMinutes;

// These two variables will be stored in the database.
$setRecoveryData=new Model\Database();
$recoveryData=$setRecoveryData->UpdateStmt("UPDATE people SET PassWordRecoveryString=\"" . $randomString	. "\",RecoveryStringTTL=" . $validUntil. "
WHERE LogonName='" . $_POST['LogonName'] . "' AND EmailAddress='" . $_POST['EmailAddress'] . "'");

// The recovery link will consist of the users emailaddress and the random string.
$recoveryLink='http://localhost:3000/passwordrecovery?pwrs=' . $randomString . '&email=' . $_POST['EmailAddress'];
echo $recoveryLink . "<br>";

// here we need some code to send the recovery link to the user.
//echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=" . $recoveryLink . "\">";

// It does not matter if the emailaddress was found or not.
// The message below will be shown.
ShowTheMessage:
echo display_message('success', 'Als uw emailadres is gevonden, dan is uw wachtwoord verstuurd naar uw emailadres.<br>Controleer ook uw spambox.') . "<meta http-equiv='refresh' content='5'>";