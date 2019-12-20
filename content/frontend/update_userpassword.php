<?php

function showmessage($type, $msg){
    echo "
<div class=\"alert alert-" . $type . "\" role=\"alert\">
  <h4 class=\"alert-heading\">" . $msg . "</h4>
</div>
<meta http-equiv='refresh' content='3'>";
}

if (!password_verify($_POST['oldpw'], $_SESSION['USER']['DATA'][0]['HashedPassword']))
    {
        showmessage('danger','Uw oude wachtwoord is onjuist.');
    return;
    }

$newDbPassword= new \Controller\AuthenticationController();
$setNewDbPassword = $newDbPassword->hashPassword($_POST['newpw1']);

// Update the password
$pushthedata=new Model\Database();
$saveTheNewPassword=$pushthedata->UpdateStmt("UPDATE people SET HashedPassword=\"" . $setNewDbPassword	. "\"
WHERE PersonId='" . $_SESSION['USER']['DATA'][0]['PersonID'] . "'");

if ($saveTheNewPassword !=0){
    showmessage('success', 'Uw wachtwoord is aangepast.');

    // Place the new data in the array.
    $_SESSION['USER']['DATA'][0]['HashedPassword']=$setNewDbPassword;
    $_SESSION['USER']['DATA'][0][3]=$setNewDbPassword;
}
