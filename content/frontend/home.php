<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';
?>
    <div>
        <div id="adv">
            //img
        </div>
        <div id="info">
                <?php $main->showContent("Home.php", "TITLE"); ?>
            <br>
                <?php $main->showContent("Home.php", "SUBTITLE"); ?>

                <?php $main->showContent("Home.php", "STORY");?>
        </div>

        <div id="categories">
            <?php $main->getGridCategories();?>
        </div>
    </div>
<?php

include_once 'content/frontend/footer.php';

?>