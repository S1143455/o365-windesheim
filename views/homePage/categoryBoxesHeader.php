<?php
//if category isn't searched, then show home text else show child categories from given category
if(!$cat_srch){
    echo '<div class="title homeTextColor">Maak een keuze uit je favoriete chocoladesoort</div>';
    echo '<div class="subtitle">Je kan via deze website onder andere kennis maken met Oma\'s gekoelde chocolade, nu voor een speciale kennismakingsprijs in elke soort smaak onder de categorie \'Chocoladerepen\'.</div>';
}else{

    echo '<div id="adv" class="col-md-12 textCenter bold banner homeTextColor title">';
    if ($cat_srch && $cat_parent->getCategoryID() != ''){echo $cat_parent->getCategoryName();};
    echo '</div>';

    include_once('views/homePage/backButton.php');
};
?>
