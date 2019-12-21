<?php

function update_UserPassword($oldPassword,$newPassword) {
    // if the old password is ThisIsPasswordRecovery there won't be a password verify.
    if ($oldPassword != 'ThisIsPasswordRecovery')
    {
        // Let's check if the old password is correct.
        if (!password_verify($oldPassword, $_SESSION['USER']['DATA'][0]['HashedPassword']))
        {
            return $result=array("hasfaild"=>true, "message"=>'Uw oude wachtwoord is onjuist.');
        }
    }

    // all is well. The new password is goint to be hashed.
    $newDbPassword= new \Controller\AuthenticationController();
    $setNewDbPassword = $newDbPassword->hashPassword($newPassword);

    // Update the password
    $pushthedata=new Model\Database();
    $saveTheNewPassword=$pushthedata->UpdateStmt("UPDATE people SET HashedPassword=\"" . $setNewDbPassword	. "\" WHERE PersonId='" . $_SESSION['USER']['DATA'][0]['PersonID'] . "'");

    // The password was stored successfully.
    if ($saveTheNewPassword !=0){
        // Place the new data in the array.
        $_SESSION['USER']['DATA'][0]['HashedPassword']=$setNewDbPassword;
        $_SESSION['USER']['DATA'][0][3]=$setNewDbPassword;
        return  $result=array("hasfaild"=>false, "message"=>'Uw wachtwoord is aangepast.');
    }

}

