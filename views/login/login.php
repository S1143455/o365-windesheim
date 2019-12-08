<?php
include 'loader.php';
include_once 'content/frontend/header.php';


    // Temporary bit of code. Its resets the $_SESSION.
    if(isset($_POST['reset'])){$_SESSION=array();}

    // Let's test the input of the user.
    if(isset($_POST['login']))
    {
        $authentication->login($_POST['gbrkr'], $_POST['pw']);
    }

?>

<form method="post" action="">
    <input type="text" name="gbrkr" placeholder="Gebruikersnaam"><br>
    <input type="password" name="pw" placeholder="Wachtwoord"><br>
    <button type="submit" name="login">Inloggen</button>
</form>
<?php if(isset($_SESSION['LOGIN_ERROR'])){echo $_SESSION['LOGIN_ERROR']; unset($_SESSION['LOGIN_ERROR']);} ?>
<?php include_once 'content/footer.php';?>
