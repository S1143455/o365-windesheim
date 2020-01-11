<?php
//use Model\User;
//$user = $userController->GetUserBydata("*", ["LogonName", "EmailAddress"], [$_POST['LogonName'], $_POST['EmailAddress']]);
//if (!$user){goto ShowTheMessage;}
//function generateRandomString($length = 55) {
//    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%^*()_+=-';
//    $charactersLength = strlen($characters);
//    $randomString = '';
//    for ($i = 0; $i < $length; $i++) {
//        $randomString .= $characters[rand(0, $charactersLength - 1)];
//    }
//    return $randomString;
//}
//$randomString=generateRandomString();
//$validMinutes=$userController->passwordRecoveryTime();
//$validUntil=time() + $validMinutes;
//$user->setPassWordRecoveryString($randomString);
//$user->setRecoveryStringTTL($validUntil);
//$userController->update($user);
//$recoveryLink='https://omasbeste.nl/passwordrecovery?pwrs=' . $randomString . '&email=' . $_POST['EmailAddress'];
//$to_email = 'klant@localhost';
//$from = "noreply@omasbeste.nl";
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$headers .= 'To: ' .$to_email. "\r\n";
//$headers .= 'From: ' .$from. "\r\n";
//$subject = 'Wachwoord herstellen';
//$message ='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title></title></head><body bgcolor="#72c0ef"><div id="email-wrap">Beste ' . $user->getFullname() . ',<br><br>Hierbij ontvangt u een link om uw wachtwoord te herstellen.<br><br><a href="'. $recoveryLink . '">Herstel link</a><br><br>Als de link niet werkt, dan moet u de onderstaande regel kopieren en in uw brouwser plakken.<br><br>'. $recoveryLink . '<br><br>Met vriendelijke groet,<br>Oma\'s Beste.<br><br>(*) Deze mail is automatisch aangemaakt. U kunt hier niet op reageren.</div></body></html>';
//mail($to_email, $subject, $message, $headers);
//ShowTheMessage:
//echo display_message('success', 'Als uw emailadres is gevonden, dan is uw wachtwoord verstuurd naar uw emailadres.<br>Controleer ook uw spambox.') . "<meta http-equiv='refresh' content='5'>";