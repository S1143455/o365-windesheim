<?php

include_once 'content/backend/header-admin.php';
?>

<div class="container">
    <div class="row">
<?php
include_once 'content/backend/sidebar-admin.php';
$content = new controller\ContentController();
?>
    <div class="col-12 col-md-9 col-lg-10">
    <link href="../theme/css/htmlEditor.css" rel="stylesheet">
        <div id="editor">
            <div id="selectie">
                <select id = "section">
                    <option value = "">Selecteer onderdeel...</option>
                    <option value = "TITLE">Titel</option>
                    <option value = "SUBTITLE">Subtitel</option>
                    <option value = "STORY">Content</option>
                </select>
            </div>
            <br>
            <?php $content->getRichTextEditor(" ");?>
        </div>
    </div>
    </div>
</div>
<?php

include_once 'content/backend/footer-admin.php';
?>