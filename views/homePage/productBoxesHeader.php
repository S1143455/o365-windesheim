<?php
if($oneCat){
    echo '<div id = "products" class="container borderTop padding-top3em">';
}else{
    echo '<div id = "products" class="container products no-padding-top">';
}

if($oneCat){

    echo '<div class="title homeTextColor">';
    echo (!$cat_srch) ? 'Onze producten' : 'Producten';
    echo '</div>';

    echo '<div class="subtitle">';
    if (!$cat_srch) {
        echo "Naast repen heeft Oma's beste een uniek assortiment voor vermaak voor jong en oud. Het management van Oma's beste heeft jarenlang ervaring op de USA markt. Hierdoor geniet u bij Oma's beste van de modernste service <u>e</u>n ambachtelijke producten!";
    } else {
        echo 'Producten uit de categorie ' . $cat_parent->getCategoryName();
    }
    echo '</div>';
}?>