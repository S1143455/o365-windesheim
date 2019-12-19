<?php
    echo '<select id = "CategoryID" class="form-control" required>
            <option value="">Selecteer een categorie...</option>';

    $categories = $category->retrieve();

    foreach($categories as $cat){
        $sCat = $cat->getCategoryName();

        if($cat->getParentCategory() != null) {
            $parentCat = $category->retrieve($cat->getParentCategory());
            $sCat .= ' (' . $parentCat->getCategoryName() . ')';
        }

        echo '<option value="' . $cat->getCategoryID() . '">' . $sCat . '</option>';
    }

    echo '</select>';