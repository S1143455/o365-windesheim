<?php
include 'loader.php';
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';
    // Let's test the input of the user.
    if (isset($_POST['login'])) {
    $authenticationController->login($_POST['gbrkr'], $_POST['pw']);
    }
if (isset($_POST['createaccount'])) {
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/" . getenv('ROOT') . "account-toevoegen\">";
}
    if (isset($_POST['sendpassword'])) {
    include "content/frontend/sendemailaddress.php";
    }
?>

<div class="row">
    <form role="form" class="loginAdminCenter" style="margin: auto;" id="table" method="POST" action="">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading mt-4">
                    <h3 class="panel-title">Inloggen</h3>
                </div>
                <div class="panel-body mt-4" style="width: 550px">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control inputUserAdminLogin" type="text" name="gbrkr"
                                   placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input class="form-control inputPasswordAdminLogin" type="password" name="pw"
                                   placeholder="Wachtwoord">
                        </div>
                        <div class="panel-footer">
                            <div class="row text-center">
                                <div class="col-3">
                                    <button type="submit" name="login" class="btn btn-success btn-block pull-left"
                                            data-toggle="modal">
                                        Inloggen
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                            data-target="#sendpassword">
                                        Wachtwoord vergeten
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="submit" name="createaccount"
                                            class="btn btn-success btn-bloc pull-left" data-toggle="modal">
                                        Account aanmaken
                                    </button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
</div>

<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <form role="form" id="table" method="POST" action="">-->
<!--            <div class="col-xs-8 col-xs-offset-2">-->
<!--                <div class="panel panel-success">-->
<!--                    <div class="panel-heading">-->
<!--                        <div class="panel-title">-->
<!--                            <div class="row">-->
<!--                                <div class="col-xs-6">-->
<!--                                    <h4><span class="glyphicon glyphicon-log-in"></span> Inloggen</h4>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="panel-body">-->
<!--                        <div class="row">-->
<!--                            <div class="col-xs-12">-->
<!--                                <div class="form-group">-->
<!--                                    <div class="input-group">-->
<!--                                        <span class="input-group-addon glyphicon glyphicon-user"></span>-->
<!--                                        <input class="form-control" type="text" name="gbrkr" placeholder="Gebruikersnaam">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row">-->
<!--                            <div class="col-xs-12">-->
<!--                                <div class="form-row align-items-center">-->
<!--                                    <div class="form-group">-->
<!--                                        <div class="input-group">-->
<!--                                            <span class="input-group-addon glyphicon glyphicon-lock"></span>-->
<!--                                            <input class="form-control" type="password" name="pw" placeholder="Wachtwoord">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="panel-footer">-->
<!--                        <div class="row text-center">-->
<!--                            <div class="col-xs-4">-->
<!--                                <button type="submit" name="login" class="btn btn-success btn-block" data-toggle="modal">-->
<!--                                    <span class="glyphicon glyphicon-log-in"></span> Inloggen-->
<!--                                </button>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4">-->
<!--                                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#sendpassword">-->
<!--                                    <span class="glyphicon glyphicon-question-sign"></span> Wachtwoord vergeten-->
<!--                                </button>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4">-->
<!--                                <button type="submit" name="createaccount" class="btn btn-success btn-block" data-toggle="modal">-->
<!--                                    <span class="glyphicon glyphicon-user"></span> Account aanmaken-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->

<div><?php if (isset($_SESSION['LOGIN_ERROR'])) {
        echo display_message($_SESSION['LOGIN_ERROR']['type'], $_SESSION['LOGIN_ERROR']['message']);
        unset($_SESSION['LOGIN_ERROR']);
    } ?></div>

<!-- form for resending password -->
<div class="modal fade" id="sendpassword" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="sendpasswordform" method="POST" action="" onsubmit="return ValidatePassword()">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
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

