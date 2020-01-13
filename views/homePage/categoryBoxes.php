<?php
$oneCat = false;
foreach($categories as $cat){
    if (!$cat_srch or $cat->getCategoryID() == ''){
        if($cat->getParentCategory() != $cat_to_srch){
            continue;
        }
    }

    $oneCat = true;
    $j = 1;
    //show category boxes
    echo '<div class="col-md-2">';
        echo '<div class="categorybox">';
            echo '<div class="categoryIMGbox">';
                echo '<form method="post" action="' . $this->root . '" class="">';
                echo '<input type="text" name="categoryID" style="display:none;" value="' . $cat->getCategoryID() . '">';
                echo '<button name="srchCategory" type="submit" value="search category">';

                $categoryAttachments = $fileController->retrieveWhereCategoryBackWards($cat->getCategoryID());

                foreach($categoryAttachments as $catAtt){

                    //only show first attachment
                    If($j==1){
                        $this->showAttachment($catAtt->getAttachmentID(), false,'img-responsive cat-img');
                    }
                    $j++;
                }
                echo '</button>';
                echo '</form>';
            echo'</div>';
          echo '<div class="cat-title">' . $cat->getCategoryName() . '</div>';
        echo '</div>';

    echo '</div>';
}
?>
