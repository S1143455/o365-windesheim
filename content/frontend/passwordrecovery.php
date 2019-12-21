<?php
include 'loader.php';
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

// check if the user has pressed the SaveNewPassword button or not.
if (isset($_POST['SaveNewPassword']))
    {
        // The user press the button so we need to save the password.
        // Since the user is not logged in, the $_SESSION with the user data doesn't exist.
        // So we need to make an key in oder to let the function 'update_UserPassword'
        // function properly.
        $_SESSION['USER']['DATA'][0]['PersonID']=$_POST['PersonID'];
        include "update_userpassword.php";
        $changepassword=update_UserPassword('ThisIsPasswordRecovery',$_POST['pw1']);
        if ($changepassword['hasfaild']==true)
        {
            echo display_message('danger', $changepassword['message']) . "<meta http-equiv='refresh' content='3' URL=/>";
        }
        else
        {
            // The password was stored succesfully. Now we need to clean up the database.
            $setClearTheData=new \Model\Database();
            $clearTheData=$setClearTheData->UpdateStmt("UPDATE people SET PassWordRecoveryString=NULL ,RecoveryStringTTL=NULL WHERE PersonID='" . $_POST['PersonID'] ."'");
            // We're done now. Let's inform the user.
            echo display_message('success', $changepassword['message']) . '<META HTTP-EQUIV=Refresh CONTENT="3;URL=/login">';
        }
    }
else
    {
        // The user did not press the button. So we need to check as few things
        // if everything is okay the user will be able to change his password.

        // If the user accidentally lands on this page without post data he will be redirected to the homepage.
            if (!isset($_POST['recoverystring']))
            {
                echo display_message('danger', 'Herstelgegevens zijn niet gevonden.');
                echo '<META HTTP-EQUIV=Refresh CONTENT="3;URL=/">';
                die;
            }

        // check if the post data is valid
        // Retrieve the user's emailaddress from the post data
            $useremail=str_replace(strtok($_POST['recoverystring'],'&').'&email=','',$_POST['recoverystring']); strtok($_POST['recoverystring'],'&');

        // Retrieve the recoverystring from the post data
            $recoverystring=str_replace('pwrs=','',str_replace('&email='.$useremail,'',$_POST['recoverystring']));

        // Lets'see if the data can be found in the database.
            $getuserdata=new \Model\Database();
            $userdata=$getuserdata->selectStmt("SELECT * FROM people WHERE EmailAddress='" . $useremail . "' AND PassWordRecoveryString='" . $recoverystring ."'" );

        // If no data can be found a message will be shown and the user will return to the homepage.
            if (!isset($userdata[0]['PersonID']))
            {
                echo display_message('danger', 'Herstelgegevens zijn niet gevonden.');
                echo '<META HTTP-EQUIV=Refresh CONTENT="3;URL=/">';
                die;
            }

        // Check if the link has expired.
            if (time() > $userdata[0]['RecoveryStringTTL'])
            {
                echo display_message('danger','De door u gebruikte link is niet meer geldig.');
                echo '<META HTTP-EQUIV=Refresh CONTENT="3;URL=/">';
                die;
            }
        // Everything appears to be okay. The user will be able to reset his password.
    }
?>
<html lang="NL">
<head></head>
    <script type="text/javascript">
        function ValidatePassword()
        {
            let firstInput = document.getElementById("pw1").value;
            let secondInput = document.getElementById("pw2").value;

            if (firstInput === secondInput) {
                return true;
            } else {
                $('#error_message').show();
                return false;
            }
        }
    </script>
    <body>
        <div class="card">
            <article class="card-body">
                <form method="post" id="recoverPasswordForm" action="" onsubmit="return ValidatePassword()">
                    <div class="form-group">
                        <label for="pw1" class="col-sm-3">Wachtwoord</label>
                        <input class="form-control" type="password" name="pw1" id="pw1" required>
                    </div>
                    <div class="form-group">
                        <label for="pw2" class="col-sm-3">Herhaal uw wachtwoord</label>
                        <input class="form-control" type="password" name="pw2" id="pw2" required>
                    </div>
                    <div id="error_message" style="display:none" class="alert alert-danger" role="alert">
                        <h4 >De wachtwoorden komen niet overeen.</h4>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="PersonID" id="PersonID" value="<?php echo $userdata[0]['PersonID']?>">
                        <button type="submit" name="SaveNewPassword" class="firstdiscountButton btn btn-primary" data-toggle="modal" value="SaveNewPassword">Opslaan</button>
                    </div>
                </form>
            </article>
        </div>
    </body>
</html>

