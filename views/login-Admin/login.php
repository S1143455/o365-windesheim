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
<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4><span class="glyphicon glyphicon-log-in"></span> Inloggen</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon glyphicon glyphicon-user"></span>
                                        <input class="form-control" type="text" name="gbrkr" placeholder="Gebruikersnaam">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-row align-items-center">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                                            <input class="form-control" type="password" name="pw" placeholder="Wachtwoord">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
