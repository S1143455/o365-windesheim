<?php
//include "Controller/Database.php";
// Wat variabelen aanmaken voor later gebruikt.
$value_naam='';

// Als er al ingegeven is, dan kijken of de gebruikersnaam ook ingegeven is.
// Is dit het geval, dan wordt deze als value gebruikt in de inputbox.
if (count($_POST) <> 0){if (strlen($_POST['gbrkr'])<> 0){$value_naam=$_POST['gbrkr'];}}

// Formulier aanmaken.
echo '<head>
    <form method="post" action="">
        <input type="text" name="gbrkr" placeholder="Gebruikersnaam" value="' . $value_naam . '"><br>
        <input type="password" name="pw" placeholder="Wachtwoord"><br>
        <button type="submit">Inloggen</button>
    </form>
</head>';

// Kijken of de lengte van de array > 0 is
if(count($_POST) !=0 )
{
    // Alk de username en/of password leeg is een melding geven.
    if (strlen($_POST['gbrkr']) == 0 || strlen($_POST['pw']) == 0){echo 'Voer een gebruikersnaam of wachtwoord in.';die;}

    // Kijken of de ingevoerde gegevens juist zijn.
    $sql="select * from users where user_name = '" . $_POST['gbrkr'] . "' and user_password='". $_POST['pw'] . "'";
    $dbnew= new Controller\Database;
    $result=$dbnew->select($sql);

    // Als we iets terug krijgen is het goed... (kennelijk)
    if (count($result) == 1){
        $new_auth= new \Controller\Authentication('users');
        $result_auth=$new_auth->login($result[0]['user_name'],$result[0]['user_password']);
        $authenticated= $new_auth->isAuthenticated();
    }
    // kennelijk zijn de ingevoerde gegevens niet juist.
    else {echo "Gebruikersnaam en/of wachtwoord is niet goed.";}
}
else {
    echo "Voer uw gebruikersnaam en wachtwoord in.<br>";
}
?>