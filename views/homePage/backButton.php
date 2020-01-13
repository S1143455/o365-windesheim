<?php
//if category is searched, then show back button
if($cat_srch){
    echo '<form method="post" action="'. $this->root . '">';
    echo '<input type="text" name="categoryID" style="display:none;" value="' . $cat_parent->getCategoryID() . '">';
    echo '<button name="back" type="submit" class="normalButton">< Terug</button>';
    echo '</form>';
};
?>