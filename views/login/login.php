<?php
include 'loader.php';
    if(isset($_POST['login']))
    {
        $authentication->login($_POST['gbrkr'], $_POST['pw']);
        die();
    }

?>
<form method="post" action="">
    <input type="text" name="gbrkr" placeholder="Gebruikersnaam" value="' . $value_naam . '"><br>
    <input type="password" name="pw" placeholder="Wachtwoord"><br>
    <button type="submit" name="login">Inloggen</button>
</form>

<!---->
<?php
//include "Controller/Database.php";
// Wat variabelen aanmaken voor later gebruikt.
$value_naam='';

// Als er al ingegeven is, dan kijken of de gebruikersnaam ook ingegeven is.
// Is dit het geval, dan wordt deze als value gebruikt in de inputbox.


    // Als de username en/of password leeg is een melding geven.


    // Kijken of de ingevoerde gegevens juist zijn.


    // Als we iets terug krijgen is het goed... (kennelijk)
    if (count($result) == 1){
        $new_auth= new \Controller\AuthenticationController();
        $result_auth=$new_auth->login($result[0]['user_name'],$result[0]['user_password']);
        $authenticated= $new_auth->isAuthenticated();
    }
    // kennelijk zijn de ingevoerde gegevens niet juist.
    else {echo "Gebruikersnaam en/of wachtwoord is niet goed.";}
}
else {
    echo "Voer uw gebruikersnaam en wachtwoord in.<br>";
}
//?>