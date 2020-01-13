<?php
use Model\Product;


include_once 'content/backend/header-admin.php';
if (isset($_POST['id'])) {
    $productID = $_POST['id'];
    if ($productID != 0) {
        $product = $productController->retrieveProduct($productID);
        echo "<script type='text/javascript'> $(document).ready(function(){ $('#EditProductDialog').modal('show');   }); </script>";
    }
}



?>
<div class="container-fluid">
    <div class="row">
            <?php include_once 'content/backend/sidebar-admin.php'; ?>
        <div class="col-12 col-md-10 col-lg-9">
            <div class="row">
                <div class="col-md-12">
                    <h3>
                        Onderhoud Producten
                    </h3>
                    <br>
                </div>
            </div>
            <div class="row" style="min-height: 50px;">
                <div class="col-md-12">
                    <input class="form-control" id="myInput" onkeyup="searchbar()" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search">
                    <br>
                </div>
            </div>
            <div class="row">
                    <div class="col-12 col-md-10 col-lg-10">
                        <form role="form" id="table" method="POST" action="">
                            <div class="table-fixed">
                                <table id="productTable" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="col-md-1">Edit</th>
                                            <th class="col-md-1">Productnr</th>
                                            <th class="col-md-1">Categorie</th>
                                            <th class="col-md-2">Omschrijving</th>
                                            <th class="col-md-1">Merk</th>
                                            <th class="col-md-1">Formaat</th>
                                            <th class="col-md-1">Barcode</th>
                                            <th class="col-md-1">Unit price (€)</th>
                                            <th class="col-md-1">BTW (%)</th>
                                            <th class="col-md-1">Totaal (€)</th>
                                            <th class="col-md-1">conversie ratio</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach($products as $prod){
                                                $categories = $category->retrieve($prod->getCategoryID());

                                                echo '<tr>';
                                                    echo '<td class="col-md-1"> <button class="tableEditButton btn btn-outline-secondary" type="submit" name="id" value="' . $prod->getStockItemID() .'">Edit</button></td>';
                                                    echo '<td class="col-md-1">' . $prod->getStockItemID() . '</td>';
                                                    echo '<td class="col-md-1">' . $categories->getCategoryName() . '</td>';
                                                    echo '<td class="col-md-2">' . $prod->getStockItemName() . '</td>';
                                                    echo '<td class="col-md-1">' . $prod->getBrand() . '</td>';
                                                    echo '<td class="col-md-1">' . $this->getSizeString($prod->getSize()) . '</td>';
                                                    echo '<td class="col-md-1">' . $prod->getBarcode() . '</td>';
                                                    echo '<td class="col-md-1">€' . number_format($prod->getUnitPrice(),2) . '</td>';
                                                    echo '<td class="col-md-1">' . number_format($prod->getTaxRate(),2) . '%</td>';
                                                    echo '<td class="col-md-1">€' . number_Format($this->calculatePrice($prod->getUnitPrice(),$prod->getTaxRate()),2) . '</td>';
                                                    echo '<td class="col-md-1">' . $this->getConversionRatio($prod) . '</td>';

                                                echo '</td>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                            </div>
                        </form>
                    </div>
                </div>
            <div class="col-12 col-md-2 col-lg-2 discountButtons">
                <button type="button" class="firstdiscountButton btn btn-success" data-toggle="modal" data-target="#createProduct">
                        Product toevoegen
                    </button>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:1000px;">
                <div class="modal-content">
                    <form role="form" id="universalModalForm" method="POST" action="CreateProduct" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span><span class="modal-title"> Toevoegen product</span></h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
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
                                        <label for="StockItemName">Product Titel</label>
                                        <input style="width:100%;" type="text" class="form-control" name="StockItemName" id="StockItemName" required>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="StockItemName">Product Omschrijving</label>
                                        <textarea style="width:100%;" class="form-control" name="StockItemDescription" id="StockItemDescription"></textarea>
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
                                        <select style="width:100%;"  id="size" class="form-control" required>
                                            <option value="">Selecteer een maat...</option>
                                            <option value="1">Extra klein</option>
                                            <option value="2">Klein</option>
                                            <option value="3">Middel</option>
                                            <option value="4">Groot</option>
                                            <option value="5">Extra groot</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="LeadTimeDays">Aanvulling voorraad (in dagen)</label>
                                        <input style="width:100%;" type="number" class="form-control" name="LeadTimeDays" id="LeadTimeDays" required>
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
                                        <input type="checkbox" class="" name="isChillerStock" id="isChillerStock" >
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unitPrice">Inkoopprijs (€)</label>
                                        <input type="number" class="form-control width100" id="unitPrice" required name="unitPrice" min="0" value="0.00" step=".01">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="taxRate">BTW (%)</label>
                                        <select id="taxRate" class="form-control width100" required>
                                            <option value="9">9%</option>
                                            <option value="21">21%</option>
                                            <option value="0">Geen</option>
                                        </select>
                                    </div>
<!--                                    <div class="col-md-4">-->
<!--                                        <label>Totaal bedrag:</label><br>-->
                                        <!--TODO:::: TOTAAL BEDRAG BEREKENEN OP FIELDCHANGE INKOOPPRIJS EN BTW -->
<!--                                        €0,00-->
<!--                                    </div>-->
                                    <div class="col-md-12">
                                        <br>
                                        <label for="attachment">Afbeeldingen</label>

                                        <input style="width: 100%;" type="file" class="form-control" name="attachmentIMG[]" multiple id="attachmentIMG[]" >
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <label for="attachment">URL</label>
                                        <input style="width: 100%;" type="text" class="form-control" name="attachmentURL" id="attachmentURL" >
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="marketingComment">Overig commentaar</label>
                                        <input style="width:100%;" type="text" class="form-control" name="marketingComment" id="marketingComment">
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
        <div class="modal fade" id="EditProductDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width:1000px;">
                <div class="modal-content">
                    <form role="form" id="EditProduct" method="POST" action="UpdateProduct">
                        <div class="modal-header">
                            <h4 class="modal-title">Product Aanpassen</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                        <input type="text" class="form-control" name="StockItemID" id="StockItemID" value="<?php echo($product->getStockItemID()) ?>" readonly required>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="StockItemName">Product Titel</label>
                                        <input style="width:100%;" type="text" class="form-control" name="StockItemName" id="StockItemName" value="<?php echo($product->getStockItemName()) ?>" required>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="StockItemName">Product Omschrijving</label>
                                        <textarea style="width:100%;" class="form-control" name="StockItemDescription" id="StockItemDescription" value="<?php echo($product->getStockItemDescription()) ?>"></textarea>
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
                                        <input type="text" class="form-control width100" name="Brand" id="Brand" required value="<?php echo($product->getBrand()) ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="size" class="">Maat</label>
                                        <select style="width:100%;"  id="size" class="form-control" required  value="<?php echo($product->getSize()) ?>">
                                            <option value="">Selecteer een maat...</option>
                                            <option value="1">Extra klein</option>
                                            <option value="2">Klein</option>
                                            <option value="3">Middel</option>
                                            <option value="4">Groot</option>
                                            <option value="5">Extra groot</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="LeadTimeDays">Aanvulling voorraad (in dagen)</label>
                                        <input style="width:100%;" type="number" class="form-control" name="LeadTimeDays" id="LeadTimeDays" required  value="<?php echo($product->getLeadTimeDays()) ?>">
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <br>
                                        <label for="barCode">Barcodenummer</label>
                                        <input type="number" class="form-control width100" name="barCode" id="barCode" required  value="<?php echo($product->getBarcode()) ?>">
                                        <br>
                                    </div>
                                    <div class="col">
                                        <label for="isChillerStock">Gekoeld product</label><br>
                                        <input type="checkbox" class="" name="isChillerStock" id="isChillerStock" >
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unitPrice">Inkoopprijs (€)</label>
                                        <input type="number" class="form-control width100" id="UnitPrice" required name="UnitPrice" min="0"  value="<?php echo($product->getUnitPrice()) ?>" step=".01">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="taxRate">BTW (%)</label>
                                        <select id="taxRate" class="form-control width100" required  value="<?php echo($product->getTaxRate()) ?>">
                                            <option value="9">9%</option>
                                            <option value="21">21%</option>
                                            <option value="0">Geen</option>
                                        </select>
                                    </div>
                                    <!--                                    <div class="col-md-4">-->
                                    <!--                                        <label>Totaal bedrag:</label><br>-->
                                    <!--TODO:::: TOTAAL BEDRAG BEREKENEN OP FIELDCHANGE INKOOPPRIJS EN BTW -->
                                    <!--                                        €0,00-->
                                    <!--                                    </div>-->
                                    <div class="col-md-12">
                                        <br>
                                        <label for="attachment">Afbeeldingen</label>

                                        <input style="width: 100%;" type="file" class="form-control" name="attachmentIMG[]" multiple id="attachmentIMG[]" >
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <label for="attachment">URL</label>
                                        <input style="width: 100%;" type="text" class="form-control" name="attachmentURL" id="attachmentURL" value="<?php echo($this->getURL($productID)) ?>" >
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="marketingComment">Overig commentaar</label>
                                        <input style="width:100%;" type="text" class="form-control" name="marketingComment" id="marketingComment" value="<?php echo($product->getMarketingComments()) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                            <input type="submit" name="submit" value="Korting aanpassen" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

include_once 'content/backend/footer-admin.php';

?>