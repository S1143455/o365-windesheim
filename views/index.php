<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';
?>
    <div>
        <div id="adv">
            //img
        </div>
        <div id="info">
            <?php $this->showContent("TITLE"); ?>
        <br>
        <?php $this->showContent("SUBTITLE"); ?>

        <?php $this->showContent( "STORY");?>
    </div>

        <div id="categories" class="padding-top3em">
            <h3>Categorieën</h3>
            <div class="row">
                <?php
                    foreach($categories as $cat){
                            if($cat->getParentCategory() != null) {
                                $parentCat = $cat->getRelation('Category');
                                $sCat = ' (' . $parentCat->getCategoryName() . ')';
                             echo $sCat;
                            };

                        if($cat->getParentCategory() == null){
                            echo '<div class="col-md-2 categorybox">';
                            echo $cat->GetCategoryName();
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
<?php
include 'content/frontend/itemlist.php';
include_once 'content/frontend/footer.php';

?>