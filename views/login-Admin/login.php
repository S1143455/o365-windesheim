<?php
include 'loader.php';
include_once 'content/backend/header-admin.php';
include 'content/backend/display_message.php';
    if(isset($_POST['login']))
    {
        $userController->login($_POST['gbrkr'], $_POST['pw']);
    }

    if (isset($_POST['sendpassword']))
    {
        include "content/backend/sendemailaddress.php";
    }
?>
<div class="container" style="margin: auto;">
    <div class="row">
        <form role="form" class="loginAdminCenter" id="table" method="POST" action="">
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inloggen</h3>
                    </div>
                    <div class="panel-body" style="width: 550px">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control inputUserAdminLogin" type="text" name="gbrkr" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <input class="form-control inputPasswordAdminLogin" type="password" name="pw" placeholder="Wachtwoord">
                            </div>
                            <div class="panel-footer">
                                <div class="row text-center">
                                    <div class="col-3">
                                        <button type="submit" name="login" class="btn btn-success btn-block pull-left" data-toggle="modal">
                                            Inloggen
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#sendpassword">
                                             Wachtwoord vergeten
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="submit" name="createaccount" class="btn btn-success btn-bloc pull-left" data-toggle="modal">
                                            Account aanmaken
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <button type="submit" name="login" class="btn btn-success btn-block" data-toggle="modal">
                                    <span class="glyphicon glyphicon-log-in"></span> Inloggen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div><?php if(isset($_SESSION['LOGIN_ERROR'])){echo display_message($_SESSION['LOGIN_ERROR']['type'],$_SESSION['LOGIN_ERROR']['message']);unset($_SESSION['LOGIN_ERROR']);}?></div>
<!-- form for resending password -->
<div class="modal fade" id="sendpassword" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="sendpasswordform" method="POST" action="" onsubmit="return ValidatePassword()">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="modal-title">Wachtwoord opvragen</span></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                </div>
                <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                    <span class="alert-body"></span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-5" for="LogonName">Uw gebruikersnaam:</label>
                        <input type="text" class="col-7 form-control" name="LogonName" id="LogonName" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-5" for="EmailAddress">Uw emailadres:</label>
                        <input type="email" class="col-7 form-control" name="EmailAddress" id="EmailAddress" required>
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
