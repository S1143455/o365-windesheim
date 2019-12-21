<?php
echo '<select id="SupplierID" class="form-control width100" required>';
echo '<option value="">Selecteer een leverancier...</option>';
foreach($suppliers as $sup){
    echo '<option value="' . $sup->getSupplierID() . '">' . $sup->getSupplierName() . '</option>';
}
echo '</select>';