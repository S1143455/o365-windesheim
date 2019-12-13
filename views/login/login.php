<?php
include 'loader.php';
include_once 'content/frontend/header.php';

    // Let's test the input of the user.
    if(isset($_POST['login']))
    {
        $authenticationController->login($_POST['gbrkr'], $_POST['pw']);
    }

    if (isset($_POST['forgotpassword']))
    {
        echo "Dat is niet handig!";
    }

?>
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
                <button type="submit" name="login" class="button" style="padding: 5px">Inloggen</button>
                <button type="submit" name="forgotpassword" class="button" style="padding: 5px">Wachtwoord vergeten</button>
            </div> <!-- form-group// -->
        </form>
    </article>
</div>
<div><?php if(isset($_SESSION['LOGIN_ERROR'])){echo $_SESSION['LOGIN_ERROR']; unset($_SESSION['LOGIN_ERROR']);} ?></div>
