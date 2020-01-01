<?php
include_once 'content/backend/header-admin.php';

?>
<div class="container-fluid">
    <div class="row">

        <?php
        include_once 'content/backend/sidebar-admin.php';
        ?>

        <div class="col-12 col-md-9 col-lg-10">
            <!--dit gaat in header -->
            <h3>
                Onderhoud Klanten
            </h3>
            <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
            <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search"
                   id="myInput" onkeyup="searchbar()">
            <br>
            <div class="row">
                <div class="col-12 col-md-7 col-lg-10">
                    <table class="table table-responsive-lg table-bordered" id="tableViewCustomer">
                        <thead>
                        <tr>
                            <th class="">Manage</th>
                            <th class="col-md-2">Klantnummer</th>
                            <th class="col-md-3">Email</th>
                            <th class="col-md-3">Naam</th>
                            <th class="col-md-2">Laatste bestelling</th>
                            <th class="col-md-2">Nieuwsbrief</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $customerController->getAllCustomer(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal to change selected row -->
<div class="modal fade" id="EditCustomerDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal"
     aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="CreateDiscount" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label" for="checkboxMD">Eenmalig:</label>
                        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxMD"
                               value="<?php echo($discount->getDealCode()) ?>">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Eenmalig</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName"
                               value="<?php echo($discount->getOneTime()) ?>">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName"
                               value="<?php echo($discount->getLastEditedBy()) ?>">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName"
                               value="<?php echo($discount->getParentCategory()) ?>">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName">
                    </div>

                    <p>some content</p>
                    <input style="" type="text" name="bookId" id="bookId" value=""/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" value="Aanmaken" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
