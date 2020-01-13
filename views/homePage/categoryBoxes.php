<?php
$oneCat = false;
foreach($categories as $cat){
    if (!$cat_srch or $cat->getCategoryID() == ''){
        if($cat->getParentCategory() != $cat_to_srch){
            continue;
        }
    }
    $oneCat = true;
    //show category boxes
    echo '<div class="col-md-2">';
    echo '<div class="categorybox">';
    echo '<div class="categoryIMGbox">';
    echo '<form method="post" action="' . $this->root . '" class="">';
    echo '<input type="text" name="categoryID" style="display:none;" value="' . $cat->getCategoryID() . '">';
    echo '<button name="srchCategory" type="submit" value="search category">';
    $this->showAttachment($cat->getAttachmentID(), false,'img-responsive cat-img');
    echo '</button>';
    echo '</form>';
    echo'</div>';
    echo '<div class="cat-title">' . $cat->getCategoryName() . '</div>';
    echo '</div>';

    echo '</div>';
}
?>
