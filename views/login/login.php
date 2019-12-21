<?php
include 'loader.php';
include_once 'content/frontend/header.php';

    // Let's test the input of the user.
    if(isset($_POST['login']))
    {
        $authenticationController->login($_POST['gbrkr'], $_POST['pw']);
    }

    if (isset($_POST['sendpassword']))
    {
        include "content/frontend/sendemailaddress.php";
    }
?>

<html lang="NL">
<head></head>
    <body>
        <div class="card">
            <article class="card-body">
        <!--        <a href="" class="float-right btn btn-outline-primary">Sign up</a>-->
        <!--        <h4 class="card-title mb-4 mt-1">Sign in</h4>-->
                <form method="post" action="">
                    <div class="form-group">
                        <label >Gebruikersnaam : </label>
                        <input class="form-control" type="text" name="gbrkr" placeholder="Gebruikersnaam">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label class="col-sm-3">Wachtwoord : </label>
                        <input class="form-control" type="password" name="pw" placeholder="Wachtwoord">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <button type="submit" name="login" class="firstdiscountButton btn btn-primary" data-toggle="modal">Inloggen</button>
                        <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#sendpassword">Wachtwoord vergeten</button>
                        <button type="submit" name="createaccount" class="firstdiscountButton btn btn-primary" data-toggle="modal">Account aanmaken</button>
                    </div> <!-- form-group// -->
                </form>
            </article>
        </div>
        <div><?php if(isset($_SESSION['LOGIN_ERROR'])){echo $_SESSION['LOGIN_ERROR']; unset($_SESSION['LOGIN_ERROR']);} ?></div>

        <!-- form for resending password -->
        <div class="modal fade" id="sendpassword" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:1000px;">
                <div class="modal-content">
                    <form role="form" id="sendpasswordform" method="POST" action="" onsubmit="return ValidatePassword()">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                            <h4 class="modal-title"><span class="modal-title">Wachtwoord opvragen</span></h4>
                        </div>
                        <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                            <span class="alert-body"></span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="LogonName">Uw gebruikersnaam</label>
                                <input type="text" class="form-control" name="LogonName" id="LogonName" required>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="EmailAddress">Uw emailadres</label>
                                <input type="email" class="form-control" name="EmailAddress" id="EmailAddress" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                            <input type="submit" name="sendpassword" value="Versturen" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

