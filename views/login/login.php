<?php
include 'loader.php';
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