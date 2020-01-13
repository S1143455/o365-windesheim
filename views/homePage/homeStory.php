<?php
//if no category searched, then show content from homepage
if (!$cat_srch){ ?>
<div id="info" class="infoHome textCenter">
    <div class="container infoText">
        <br>

        <div class="title">
            <?php $this->showContent("SUBTITLE"); ?>
        </div>

        <?php $this->showContent("STORY");
        };
        ?>
    </div>
</div>