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
            <?php
                $result = $database->Select("SELECT a.FileLocation FROM content CON INNER JOIN content_category cc on CON.PageID = cc.PageID and CON.Section = cc.Section INNER JOIN category c on cc.CategoryID = c.CategoryID INNER JOIN attachments a on c.CategoryID = a.CategoryID WHERE CON.PageID = 'Home.PHP' AND CON.Section = 'Categories' AND CON.Upd_dt = (SELECT MAX(CONN.Upd_dt) FROM content CONN WHERE CONN.PageID = CON.PageID AND CONN.Section = CON.Section);");
                $main->generateGrid($result,"col-12 col-sm-6 col-md-4");
            ;?>
        </div>
    </div>
<?php

include_once 'content/frontend/footer.php';

?>