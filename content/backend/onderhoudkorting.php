
<?php

include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';
?>
    < class="container">
    <div>
        Onderhoud Korting
        <div class="search">
            <input type="text" class="searchTerm" placeholder="Waar ben je naar op zoek?">
            <button type="button" class="searchButton" <p>Zoeken</p>
        </div>
    </div>
    <div>
        <div class="eenmaligekortingButton"
            <button><a href="#open-eenmaligekorting">Eenmalige korting</a></button>
        <div id="open-eenmaligekorting" class="eenmaligekortingWindow">
            <div>
                <a href="onderhoud-korting" title="Close" class="eenmaligekortingClose">Sluiten &times;</a>
                <h1>Eenmalige korting aanmaken</h1>
            </div>
        </div>
    </div>
<div>
    <div class="kortingopproductButton"
        <button><a href="#open-kortingopproduct">Korting op product(en)</a></button>
    <div id="open-kortingopproduct" class="kortingopproductWindow">
        <div>
            <a href="onderhoud-korting" title="Close" class="kortingopproductClose">Sluiten &times;</a>
            <h1>Korting op product(en) aanmaken</h1>
        </div>
    </div>
</div>

<div>
    <div class="kortingopcategorieButton"
        <button><a href="#open-kortingopcategorie">Korting op categorie(ën)</a></button>
    <div id="open-kortingopcategorie" class="kortingopcategorieWindow">
        <div>
            <a href="onderhoud-korting" title="Close" class="kortingopcategorieClose">Sluiten &times;</a>
            <h1>Korting op categorie(ën) aanmaken</h1>
        </div>
    </div>
</div>

    <div>
    <div class="kortingmailenButton"
        <button type="submit" <p>Korting mailen naar klant</p>
    </div>

<?php
include_once 'content/backend/footer-admin.php';


?>
