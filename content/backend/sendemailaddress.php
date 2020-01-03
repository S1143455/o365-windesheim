<?php
// Let's see if we can find the emailaddress of the user.
use Model\User;
$emailAddress = $userController->GetEmailByName("FullName, EmailAddress", ["LogonName", "EmailAddress"], [$_POST['LogonName'], $_POST['EmailAddress']]);
//$getEmailAddress= new \Model\Database();
//$emailAddress =
//$emailAddress=$getEmailAddress->selectStmt("SELECT  FROM people WHERE LogonName='" . $_POST['LogonName'] . "' AND EmailAddress='" . $_POST['EmailAddress'] . "'");

// If the combination of the username and the emailaddress was not found. The rest of the code will not be executed.
// The 'mail has been send' message will be shown.
if (!$emailAddress){goto ShowTheMessage;}

// If the combination of the username and the emailaddress was found a mail will be send with a link to reset the password.
// The link will contain a random string and is valid for a set amount of minutes only.
// If the time expires the user will need to request a new link.

// First off : The function for the random string
function generateRandomString($length = 55) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%^*()_+=-';
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
$recoveryLink='https://omasbeste.nl/passwordrecovery?pwrs=' . $randomString . '&email=' . $_POST['EmailAddress'];
//echo $recoveryLink . "<br>";

// here we need some code to send the recovery link to the user.

$to_email = 'klant@localhost';
$from = "noreply@omasbeste.nl";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers
$headers .= 'To: ' .$to_email. "\r\n";
$headers .= 'From: ' .$from. "\r\n";
$subject = 'Wachwoord herstellen';
$message ='
    <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title></title>
        </head>
        <body bgcolor="#72c0ef">
            <div id="email-wrap">
Beste ' . $emailAddress[0]['FullName'] . ',<br><br>
Hierbij ontvangt u een link om uw wachtwoord te herstellen.<br><br>
<a href="'. $recoveryLink . '">Herstel link</a><br><br>
Als de link niet werkt, dan moet u de onderstaande regel kopieren en in uw brouwser plakken.<br><br>
'. $recoveryLink . '<br><br>
Met vriendelijke groet,<br>Oma\'s Beste.<br><br>(*) Deze mail is automatisch aangemaakt. U kunt hier niet op reageren.
</div>
        </body>
        </html>';

// If the mailaddresses match the mail will be send.
mail($to_email, $subject, $message, $headers);

// It does not matter if the emailaddress was found or not.
// The message below will be shown.
ShowTheMessage:
echo display_message('success', 'Als uw emailadres is gevonden, dan is uw wachtwoord verstuurd naar uw emailadres.<br>Controleer ook uw spambox.') . "<meta http-equiv='refresh' content='5'>";