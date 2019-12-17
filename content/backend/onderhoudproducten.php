<?php
include_once 'content/backend/header-admin.php';
use Model\Product;

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
                    <table id="productTable" class="table table-fixed">
                        <thead>
                            <tr>
                                <th class="col-xs-1">Productnummer</th>
                                <th class="col-xs-2">Categorie</th>
                                <th class="col-xs-3">Omschrijving</th>
                                <th class="col-xs-1">Prijs</th>
                                <th class="col-xs-1">Voorraad</th>
                                <th class="col-xs-2">Start verkoop</th>
                                <th class="col-xs-2">Eind verkoop</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $productController->buildTableRowsProducts(); ?>
                        </tbody>
                    </table>
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
                        <div class="modal-body row">
                            <div class="form-group col-md-10">
                                <div class="col-md-12">
                                    <label for="CategoryID">Categorie</label>
                                    <select id = "CategoryID" class="form-control" required>
                                        //TODO:::::: Categorieën ophalen en in select droppen
                                        <option value="">Selecteer een categorie...</option>
                                        <option value="CategoryID1">Categorie 1</option>
                                        <option value="CategoryID2">Categorie 2</option>
                                        <option value="CategoryID3">Categorie 3</option>
                                        <option value="CategoryID4">Categorie 4</option>
                                    </select>
                                    <br>
                                    <label for="StockItemID">Productnummer</label>
                                    <input type="text" class="form-control" name="StockItemID" id="StockItemID" value = "Nieuw" readonly required>
                                    <br>
                                    <label for="StockItemName">Omschrijving</label>
                                    <input type="text" class="form-control" name="StockItemName" id="StockItemName" required>
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4 nopadding">
                                        <label for="SupplierID">Leverancier</label>
                                        <select id="SupplierID" class="form-control width100" required>
                                            //TODO:::::: Leveranciers ophalen en in select droppen
                                            <option value="">Selecteer een leverancier...</option>
                                            <option value="LeverancierID1">Leverancier 1</option>
                                            <option value="LeverancierID2">Leverancier 2</option>
                                            <option value="LeverancierID3">Leverancier 3</option>
                                            <option value="LeverancierID4">Leverancier 4</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-4 nopadding">
                                        <label for="brand">Merk</label>
                                        <input type="text" class="form-control width100" name="brand" id="brand" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <label for="size" class="">Maat</label>
                                    <select id="size" class="form-control" required>
                                        <option value="">Selecteer een maat...</option>
                                        <option value="S">Klein</option>
                                        <option value="M">Middel</option>
                                        <option value="L">Groot</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <label for="loadTimeDays">Aanvulling voorraad (in dagen)</label>
                                    <input type="number" class="form-control" name="loadTimeDays" id="loadTimeDays" required>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="col-md-3 nopadding">
                                        <label for="unitPrice">Prijs (€)</label>
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

                                    <div class="col-md-2">
                                        <label>Totaal bedrag:</label>
                                        <!--TODO:::: TOTAAL BEDRAG BEREKENEN -->
                                        €0,00
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="col-md-6 nopadding">
                                        <label for="barCode">Barcodenummer</label>
                                        <input type="number" class="form-control width100" name="barCode" id="barCode" required>
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-2 nopadding">
                                        <label for="isChillerStock">Gekoeld product</label>
                                        <input type="checkbox" class="" name="isChillerStock" id="isChillerStock" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <label for="attachment">Afbeelding</label>
                                    <input type="file" class="form-control" name="attachment" id="attachment" required>
                                    <br>
                                    <label for="marketingComment">Overig commentaar</label>
                                    <input type="text" class="form-control height15pct" name="marketingComment" id="marketingComment" required>
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