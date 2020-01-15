<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';

use Model\Customer;
?>

<?php {
    $nameErr = "";
    $passwordErr = "";
    $emailErr = "";
    $usrnameErr = "";
    $tandcErr = "";
    $name = "";
    $password = "";
    $usrname = "";
    $tandc = "";
    $email = "";
    $succes = true;

    if (isset($_POST['submit'])) {
        include 'loader.php';

        if ($_POST['HashedPassword1'] == $_POST['HashedPassword2']) {
            $email = $customerController->Test_Input($_POST["EmailAddress"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        } else {
            $passwordErr = "password not same";
        }
        if ($succes) {
            $customerController->createMultipleP();
        } else {
            echo "Er is iets mis gegaan!";
        }
        //die();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["FullName"])) {
            $nameErr = "Naam is verplicht";
        } else {
            $name = $customerController->Test_Input($_POST["FullName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Alleen letters worden geaccpeteerd";
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["LogonName"])) {
                $usrnameErr = "Gebruikersnaam is verplicht";
            } else {
                $name = $customerController->Test_Input($_POST["LogonName"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $nameErr = "Alleen letters worden geaccpeteerd";
                }
            }

            if (empty($_POST["EmailAddress"])) {
                $emailErr = "Email is verplicht";
            } else {
                $email = $customerController->Test_Input($_POST["EmailAddress"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Onjuiste email notatie";
                }
            }

            if (empty($_POST["TermsAndConditions"])) {
                $genderErr = "U dient akkoord te gaan met onze algemene voorwaarden!";
            } else {
                $tandc = $customerController->Test_Input($_POST["TermsAndConditions"]);
            }
        }
    }
}
?>
<p><h2>Account aanmaken</h2></p> </br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form role="form" id="AddAccount" method="POST" action="">
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
                        <input type="text" Name="FullName" class="form-control" id="Fullname" placeholder="Voor & Achternaam Invullen">
                        <span class="error">* <?php echo $nameErr;?></span>
                    </div>
                    <div class="col-md-6">
                        <label for="UserName">Gebruikersnaam</label>
                        <input type="text" name="LogonName" class="form-control" id="LogonName" placeholder="Gebruikersnaam Invullen">
                        <span class="error">* <?php echo $usrnameErr;?></span>
                    </div>
                    <div class="col-md-6">
                        <label for="UserEmail">Email</label>
                        <input type="text" name="EmailAddress" class="form-control" id="EmailAddress" placeholder="Email Invullen">
                        <span class="error">* <?php echo $emailErr;?></span>
                    </div>
                    <div class="col-md-6">
                        <label for="PhoneNumber">Telefoonnummer</label>
                        <input type="text" name="PhoneNumber" class="form-control" id="PhoneNumber" placeholder="Telefoonnummer Invullen">
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="DateOfBirth">Geboortedatum</label>
                    <input type="date" name="dateofbirth" class="form-control" id="dateofbirth" ">
                </div>
                <div class="form-group">
                <label for="InputPassword">Wachtwoord</label>
                <input type="password" name="HashedPassword1" class="form-control" id="HashedPassword1" placeholder="Wachtwoord">
                    <span class="error">* <?php echo $passwordErr;?>
        </div>
                <div class="form-group">
                    <label for="InputRepeatPassword">Herhaal wachtwoord</label>
                    <input type="password" name="HashedPassword2" class="form-control" id="HashedPassword2" placeholder="Herhaal Wachtwoord">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="NewsLetter" class="form-check-input" id="NewsLetter">
                    <label class="form-check-label" for="newsletter">Ja! Ik ontvang graag de Nieuwsbrief van Oma's beste</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="TermsAndConditions" class="form-check-input" id="TermsAndConditions">
                    <span class="error">* <?php echo $tandcErr;?>
                    <label class="form-check-label" for="TermsAndConditions">Ik ga akkoord met de algemene voorwaarden*</label>
                </div>
<!--                //<input type="submit" name="submit" value="Registreren1" class="btn btn-primary">-->

                <input type="submit" name="submit" value="Registreren" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php
//
//{
//    $fullname= $_POST["FullName"];
//    $usrname= $_POST["UserName"];
//    $usremail= $_POST["EmailAddress"];
//    $usrphone= $_POST["PhoneNumber"];
//    $system= "1";
//    $pwd= $_POST["pwd"];
//    $termsandconditions = $_POST["GenConditions"];
//    $newsletter = $_POST["NewsLetter"];
//    $gender = $_POST["Gender"];
//    $register_sql='insert into people (fullName, logonname, emailaddress, phonenumber, hashedpassword, lasteditedby)
//                   values ("'.$fullname.'", "'.$usrname.'", "'.$usremail.'", "'.$usrphone.'", "'.$pwd.'", "'.$system.'")
//                   insert into customer (gender, newsletter, termsandconditions)
//                   values ("'.$gender.','.$newsletter.','.$termsandconditions.'")';
//
//    echo "$register_sql";
//
//}
//
//
//else
//{
//    echo "Je hebt niet alle vereiste gegevens ingevuld";

?>


<?php
 include_once 'content/footer.php';
?>