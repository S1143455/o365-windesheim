<?php
    echo '<form method="post" action="' . $this->root . '" class="margin-bottom1em">';
    echo '<input type="text" name="prodCounter" style="display:none;" value ="' . $prod_counter . '">';
    echo '<input type="text" name="categoryID" style="display:none;" value="' . (($cat_srch) ? $cat_parent->getCategoryID() : '') . '">';

    if($prod_counter - $productsPerPage > 0){
        echo '<button type="submit" name="previous" class="normalButton">Vorige</button>';
    }
    echo '&nbsp&nbsp';
    if((count($products) - $productsPerPage) > 12) {
        echo '<button type="submit" name="next" class="normalButton">Volgende</button>';
    }
    echo '</form>';
?>