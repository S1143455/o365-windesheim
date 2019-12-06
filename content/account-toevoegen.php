<?php
include_once 'content/header.php';
include_once 'loader.php';
?>

<p>Hallo allemaal</p> </br>
<div class="container">
<form method="post">
    Volledige naam:<input type="text" name="fullname" value=""></br>
    Login naam:<input type="text" name="logonname" value=""></br>
    Email:<input type="text" name="emailaddress" value=""></br>
    Telefoonnummer:<input type="text" name="phonenumber" value=""></br>
    Wachtwoord:<input type="password" name="pwd" value=""></br>
    Herlaal wachtwoord:<input type="password" name="pwdcheck" value=""></br>
    <input type="submit" name="register" value="registreren">
</form>
</div>
<?php

if (isset($_POST["register"])) {

    $fullname= $_POST["fullname"];
    $usrname= $_POST["logonname"];
    $usremail= $_POST["emailaddress"];
    $usrphone= $_POST["phonenumber"];
    $pwd= $_POST["pwd"];
    $register_sql='insert into people (fullName, logonname, emailaddress, phonenumber, hashedpassword, lasteditby) values ("'.$fullname.'", "'.$usrname.'", "'.$usremail.'", "'.$usrphone.'", "'.$pwd.'", "'.$usrname.'")';


} else {
    echo "flikker op";
    }
    ?>

<?php
include_once 'content/footer.php';
?>