<?php
//include "Classes/Database.php";
// Wat variabelen aanmaken voor later gebruikt.
$value_naam='';
// Als er al ingegeven is, dan kijken of de gebruikersnaam ook ingegeven is.
// Is dit het geval, dan wordt deze als value gebruikt in de inputbox.
if (count($_POST) <> 0){if (strlen($_POST['gbrkr'])<> 0){$value_naam=$_POST['gbrkr'];}}

// Formulier aanmakn.
echo '<head>
    <form method="post" action="">
        <input type="text" name="gbrkr" placeholder="Gebruikersnaam" value="' . $value_naam . '"><br>
        <input type="password" name="pw" placeholder="Wachtwoord"><br>
        <button type="submit">Inloggen</button>
    </form>
</head>';

// Kijken of de lengte van de array > 0 is
if(count($_POST) <> 0 )
{
    if (strlen($_POST['gbrkr']) == 0 || strlen($_POST['pw']) == 0){echo 'Voer een gebruikersnaam of wachtwoord in.';die;}
    $sql="select * from users where user_name = '" . $_POST['gbrkr'] . "' and user_password='". $_POST['pw'] . "'";
    echo $sql . "<br>";
    $select=new Classes\Database('select');
    $dbnew= new Classes\Database;
    $result=$dbnew->select($sql);
    print_r($result);
}
else {
    echo "Voer uw gebruikersnaam en wachtwoord in.<br>";
}
?>