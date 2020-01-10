<?php
use Model\Product;

if (isset($_POST['id'])) {
    $productID = $_POST['id'];
    $this->show1($productID);
}else{
    include_once 'content/backend/header-admin.php';
}


?>
    <div class="container" style="width:100%">
        <div class="row">

            <?php
            include_once 'content/backend/sidebar-admin.php';
            ?>

            <div class="col-md-10">
                <div class="row" style="min-height: 50px;">

                </div>
                <div class="row" style="min-height: 50px;">
                    <div class="col-md-7">
                        <input class="form-control" id="myInput" onkeyup="searchbar()" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search">
                    </div>
                </div>

                <div class="row">
                    <form role="form" id="table" method="POST" action="">
                        <table id="productTable" class="table table-fixed">
                            <thead>
                            <tr>
                                <th class="col-xs-1">Productnr</th>
                                <th class="col-xs-2">Categorie</th>
                                <th class="col-xs-2">Omschrijving</th>
                                <th class="col-xs-2">Merk</th>
                                <th class="col-xs-1">Formaat</th>
                                <th class="col-xs-1">Barcode</th>
                                <th class="col-xs-1">Inkoopprijs</th>
                                <th class="col-xs-1">BTW (%)</th>
                                <th class="col-xs-1">Totaal (€)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($products as $prod){
                                    $categories = $category->retrieve($prod->getCategoryID());

                                    echo '<tr>';
                                        echo '<td class="col-xs-1"> <button type="submit" name="id" value="' . $prod->getStockItemID() .'">Edit</button></td>';
                                        echo '<td class="col-xs-1">' . $prod->getStockItemID() . '</td>';
                                        echo '<td class="col-xs-2">' . $categories->getCategoryName() . '</td>';
                                        echo '<td class="col-xs-2">' . $prod->getStockItemName() . '</td>';
                                        echo '<td class="col-xs-1">' . $prod->getBrand() . '</td>';
                                        echo '<td class="col-xs-1">' . $this->getSizeString($prod->getSize()) . '</td>';
                                        echo '<td class="col-xs-1">' . $prod->getBarcode() . '</td>';
                                        echo '<td class="col-xs-1">€' . number_format($prod->getUnitPrice(),2) . '</td>';
                                        echo '<td class="col-xs-1">' . number_format($prod->getTaxRate(),2) . '%</td>';
                                        echo '<td class="col-xs-1">€' . number_Format($this->calculatePrice($prod->getUnitPrice(),$prod->getTaxRate()),2) . '</td>';
                                    echo '</td>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </form>

                </div>
            </div>

            <div class="row">
                <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#createProduct">
                    Product toevoegen
                </button>
            </div>
        </div>

        <div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:1000px;">
                <div class="modal-content">
                    <form role="form" id="universalModalForm" method="POST" action="test">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span><span class="modal-title"> Toevoegen product</span></h4>
                        </div>
                        <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                            <span class="alert-body"></span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">

                                <div class="row width100">
                                    <div class="col-md-12">
                                        <label for="CategoryID">Categorie</label>
                                        <?php
                                            include_once ('views/category/categoriesAllSelect.php');
                                        ?>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="StockItemID">Productnummer</label>
                                        <input type="text" class="form-control" name="StockItemID" id="StockItemID" value = "Nieuw" readonly required>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="StockItemName">Omschrijving</label>
                                        <input type="text" class="form-control" name="StockItemName" id="StockItemName" required>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="SupplierID">Leverancier</label>
                                        <?php
                                            include_once('views/supplier/suppliersAllSelect.php');
                                        ?>
                                        <br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="brand">Merk</label>
                                        <input type="text" class="form-control width100" name="brand" id="brand" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="size" class="">Maat</label>
                                        <select id="size" class="form-control" required>
                                            <option value="">Selecteer een maat...</option>
                                            <option value="1">Extra klein</option>
                                            <option value="2">Klein</option>
                                            <option value="3">Middel</option>
                                            <option value="4">Groot</option>
                                            <option value="5">Extra groot</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="loadTimeDays">Aanvulling voorraad (in dagen)</label>
                                        <input type="number" class="form-control" name="loadTimeDays" id="loadTimeDays" required>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <br>
                                        <label for="barCode">Barcodenummer</label>
                                        <input type="number" class="form-control width100" name="barCode" id="barCode" required>
                                        <br>
                                    </div>
                                    <div class="col">
                                        <label for="isChillerStock">Gekoeld product</label><br>
                                        <input type="checkbox" class="" name="isChillerStock" id="isChillerStock" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unitPrice">Inkoopprijs (€)</label>
                                        <input type="number" class="form-control width100" name="unitPrice" id="unitPrice" value="0.00" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="taxRate">BTW (%)</label>
                                        <select id="taxRate" class="form-control width100" required>
                                            <option value="9">9%</option>
                                            <option value="21">21%</option>
                                            <option value="0">Geen</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Totaal bedrag:</label><br>
                                        <!--TODO:::: TOTAAL BEDRAG BEREKENEN OP FIELDCHANGE INKOOPPRIJS EN BTW -->
                                        €0,00
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <label for="attachment">Afbeelding</label>
                                        <input type="file" class="form-control" name="attachment" id="attachment" required>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="marketingComment">Overig commentaar</label>
                                        <input type="text" class="form-control height15pct" name="marketingComment" id="marketingComment" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="submit" value="Opslaan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

include_once 'content/backend/footer-admin.php';

?>