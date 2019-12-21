<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';
?>
    <div>
        <div id="adv">
            //img
        </div>
        <div id="info">
                <?php $mainController->showContent("TITLE"); ?>
            <br>
                <?php $mainController->showContent("SUBTITLE"); ?>

                <?php $mainController->showContent( "STORY");?>
        </div>

        <div id="categories">
            <?php $mainController->getGridCategories();?>
        </div>
    </div>
<?php

include_once 'content/frontend/footer.php';

?>