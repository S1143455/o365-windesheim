<?php
include 'loader.php';
include_once 'content/frontend/header.php';

    // Let's test the input of the user.
    if(isset($_POST['login']))
    {
        $authentication->login($_POST['gbrkr'], $_POST['pw']);
    }

    if (isset($_POST['forgotpassword']))
    {
        echo "yuo stupid succer!";
    }

?>

    <form method="post" action="">
        <div class="row justify-content-between">
            <label class="col-sm-3">Gebruikersnaam : </label>
            <input type="text" name="gbrkr" placeholder="Gebruikersnaam" class="col-sm-6">
        </div>
        <div class="row justify-content-between">
            <label class="col-sm-3">Wachtwoord : </label>
            <input type="password" name="pw" placeholder="Wachtwoord" class="col-sm-6">
        </div>
        <div class="row justify-content-md-center">
            <div class="col-sm-1"><button type="submit" name="login" class="button" style="padding: 5px">Inloggen</button></div>
            <div class="col-sm-1"><button type="submit" name="forgotpassword" class="button" style="padding: 5px">Wachtwoord vergeten</button></div>
        </div>
    </form>
<div><?php if(isset($_SESSION['LOGIN_ERROR'])){echo $_SESSION['LOGIN_ERROR']; unset($_SESSION['LOGIN_ERROR']);} ?></div>
