<?php
    "Hallo";
    if(isset($_POST))
    {
        echo 'Post found';
        print_r($_POST);
        //die();
    }
    else {
        echo "No post found!";
}
?>
<head>
    <form action="">
        <input type="text" class="form-control" name="gbrkr" placeholder="Gebruikersnaam"><br>
        <input type="password" class="form-control" name="pw" placeholder="Wachtwoord"><br>
        <button type="submit" name="login">Inloggen</button>
    </form>
</head>
