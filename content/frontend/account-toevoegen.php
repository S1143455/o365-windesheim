<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';
include_once 'model/database.php';
?>

<p><h2>Account aanmaken</h2></p> </br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post">
                <div class="form-group">
                    <div class="row">
                        <h4>Aanhef</h4>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Gender" id="GenderMan" value="Man" checked>
                            <label class="form-check-label" for="inlineRadio">De heer</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Gender" id="GenderWoman" value="Woman">
                            <label class="form-check-label" for="inlineRadio">Mevrouw</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Gender" id="GenderUnknown" value="Unknown">
                            <label class="form-check-label" for="inlineRadio">Onbekend</label>
                        </div>
                    <div class="col-md-6">
                        <label for="InputFullname">Voor & Achternaam</label>
                        <input type="text" Name="FullName" class="form-control" id="InputFullname" placeholder="Voor & Achternaam Invullen">
                    </div>
                    <div class="col-md-6">
                        <label for="UserName">Gebruikersnaam</label>
                        <input type="text" name="UserName" class="form-control" id="UserName" placeholder="Gebruikersnaam Invullen">
                    </div>
                    <div class="col-md-6">
                        <label for="UserEmail">Email</label>
                        <input type="text" name="EmailAddress" class="form-control" id="EmailAddress" placeholder="Email Invullen">
                    </div>
                    <div class="col-md-6">
                        <label for="PhoneNumber">Telefoonnummer</label>
                        <input type="text" name="PhoneNumber" class="form-control" id="PhoneNumber" placeholder="Telefoonnummer Invullen">
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="InputPassword">Wachtwoord</label>
                    <input type="password" name="pwd" class="form-control" id="InputPassword" placeholder="Wachtwoord">
                </div>
                <div class="form-group">
                    <label for="InputRepeatPassword">Herhaal wachtwoord</label>
                    <input type="password" name="Repeatpwd" class="form-control" id="InputRepeatPassword" placeholder="Herhaal Wachtwoord">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="NewsLetter">
                    <label class="form-check-label" name="NewsLetter" for="Newsletter">Ja! Ik ontvang graag de Nieuwsbrief van Oma's beste</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="GenConditions">
                    <label class="form-check-label" name="GenConditions" for="GenConditions">Ik ga akkoord met de algemene voorwaarden*</label>
                </div>
                <button type="submit" name="register" class="btn btn-primary">Registreren</button>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_POST["register"]))
{
    $fullname= $_POST["FullName"];
    $usrname= $_POST["UserName"];
    $usremail= $_POST["EmailAddress"];
    $usrphone= $_POST["PhoneNumber"];
    $system= "1";
    $pwd= $_POST["pwd"];
    $termsandconditions = $_POST["GenConditions"];
    $newsletter = $_POST["NewsLetter"];
    $gender = $_POST["Gender"];
    $register_sql='insert into people (fullName, logonname, emailaddress, phonenumber, hashedpassword, lasteditedby) 
                   values ("'.$fullname.'", "'.$usrname.'", "'.$usremail.'", "'.$usrphone.'", "'.$pwd.'", "'.$system.'")
                   insert into customer (gender, newsletter, termsandconditions) 
                   values ("'.$gender.','.$newsletter.','.$termsandconditions.'")';

    echo "$register_sql";

}


else
{
    echo "flikker op";
}
?>


<?php
 include_once 'content/footer.php';
?>