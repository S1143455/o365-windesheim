<?php
include_once 'content/header.php';
?>

<p>Hallo allemaal</p> </br>
<div class="container">
<form method="post">
    Naam:<input type="text" name="user_name" value=""></br>
    Email:<input type="text" name="user_email" value=""></br>
    Wachtwoord:<input type="password" name="pwd" value=""></br>
    Herlaal wachtwoord:<input type="password" name="pwdcheck" value=""></br>
    <input type="submit" name="register" value="registreren">
</form>
</div>
<?php
if (isset($_POST["register"])) {
    echo "Yeah let's go" ;
} else {
    echo "flikker op";
}
?>

<?php
include_once 'content/footer.php';
?>

