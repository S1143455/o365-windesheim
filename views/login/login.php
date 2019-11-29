<?php
    "Hallo";
    if(isset($_POST))
    {
        echo 'Post found';
        die();
    }
?>

<form action="/login.php">
    <button type="submit">login</button>
        <input type="text" class="form-control" name="gbrkr" placeholder="Gebruikersnaam">
        <input type="password" class="form-control" name="pw" placeholder="Wachtwoord">
    <input type="submit">
</form>