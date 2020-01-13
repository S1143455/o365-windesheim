<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div id="adv">
            //img
        </div>
        <div  class="col-12" id="info">
                <?php $mainController->showContent("TITLE"); ?>
            <br>
                <?php $mainController->showContent("SUBTITLE"); ?>

                <?php $mainController->showContent( "STORY");?>
        </div>

        <div  class="col-12" id="categories">
            <?php $mainController->getGridCategories();?>
        </div>
    </div>
    </div>
</div>
<?php

include_once 'content/frontend/footer.php';

?>