<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';
?>

    <div class="container">
        <div class="adv">

        </div>

        <div class = "info">
                <?php
                   echo $main->getContent("Home.php", "TITLE"); ?>
            <br>
                <?php echo $main->getContent("Home.php", "SUBTITLE"); ?>

                <?php echo $main->getContent("Home.php", "STORY");?>
        </div>
    </div>
<?php

include_once 'content/frontend/footer.php';

?>