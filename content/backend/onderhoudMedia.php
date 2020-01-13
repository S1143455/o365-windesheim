<?php
include_once 'content/backend/header-admin.php';

use Model\Attachments;
use Model\AttachmentCategorie;
Use Model\AttachmentStockItem;
$attachments = $fileController->retrieveAll();
if (isset($_POST['id'])) {
    $attachmentID = $_POST['id'];
    if ($attachmentID != 0) {
        $attachment = $fileController->retrieve($attachmentID);
//        $attachment = $fileController->retrieveWhereCategory($attachmentID);
//        $attachment = $fileController->retrieveWhereStockitem($attachmentID);
        echo "<script type='text/javascript'> $(document).ready(function(){ $('#EditMediaDialog').modal('show');   }); </script>";
    }

}
?>
    <div class="container-fluid">
        <div class="row">

            <?php
            include_once 'content/backend/sidebar-admin.php';
            ?>

            <div class="col-12 col-md-9 col-lg-10">
                <!--dit gaat in header -->
                <h3>
                    Onderhoud Media
                </h3>
                <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
                <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search"
                       id="myInputCustomer">
                <br>

                <div class="row">
                    <div class="col-12 col-md-7 col-lg-10 tableViewCustomer">
                        <form role="form" id="table" method="POST" action="">
                            <div class="table-fixed">
                                <table class="table table-bordered" id="tableViewCustomer">
                                    <thead>
                                    <tr>
                                        <th class="col-md-2">Manage</th>
                                        <th class="col-md-3">Alternatieve omschrijving</th>
                                        <th class="col-md-3">Locatie</th>
                                        <th class="col-md-2">Gekoppelde Categorieën</th>
                                        <th class="col-md-2">Gekoppelde producten</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyCustomer">
<!--                                    --><?php $fileController->getAllAttachments($attachments); ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 discountButtons">
                        <!-- discount option buttons  -->
                        <button type="button" class="discountButton btn btn-success" data-toggle="modal"
                                data-target="#NewFile">
                            Media Upload
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="NewFile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="min-width: 1000px;">
            <div class="modal-content">
                <form role="form" id="universalModalForm" method="POST" action="NewFile" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Media Uploaden</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">

                            <p>
                                <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                                   href="#tableCollapseProduct" role="button"
                                   aria-expanded="false" aria-controls="tableCollapse">Product zoeken</a>
                            </p>
                            <div class="tableCollapseProduct">
                                <div class="collapse multi-collapse" id="tableCollapseProduct">
                                    <div class="card card-body" style="padding:0px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-fixed"  id="tableCollapseProduct" >
                                                    <thead>
                                                    <tr>
                                                        <th class="col-md-2">Select</th>
                                                        <th class="col-md-2">Productnr</th>
                                                        <th class="col-md-3">Productnaam</th>
                                                        <th class="col-md-1">Prijs</th>
                                                        <th class="col-md-4">Opmerkingen</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbodyProduct">
                                                        <?php $discountController->GetAllProducts(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                                   href="#tableCollapseCategorie" role="button"
                                   aria-expanded="false" aria-controls="tableCollapse">Categorie zoeken</a>
                            </p>
                            <div class="tableCollapseCategorie">
                                <div class="collapse multi-collapse" id="tableCollapseCategorie">
                                    <div class="card card-body" style="padding:0px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-fixed"  id="tableCollapseCategorie" >

                                                    <thead>
                                                    <tr>
                                                        <th class="col-md-2">Select</th>
                                                        <th class="col-md-2">CategorieNr</th>
                                                        <th class="col-md-8">Omschrijving</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbodyCategorie">
                                                        <?php $discountController->GetAllCategoriesForAttachments(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-5 control-label" for="alternateText">Alternatieve Tekst:</label>
                                <input class="col-2 form-control" type="text" name="alternateText"
                                       id="alternateText">
                            </div>
                            <div class="form-group">
                                <label class="col-md-3" for="AttachmentID">Afbeelding</label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                        <button type="submit" class="btn btn-primary" name="submit">Attachment aanmaken</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal to edit selected table row in a modal -->
    <div class="modal fade" id="EditMediaDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form role="form" id="EditCustomer" method="POST" action="">
                    <div class="modal-header">
                        <h4 class="modal-title">Media details</h4>
                        <p style="background-color: black; color:red;">Waarschuwing, deze edit scherm overschrijft de oude afbeelding(file word niet verwijdert, attachment id word nieuwe oude word verwijdert, producten zoals ze hier ingevult staan worden geupload).</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">

                            <p>
                                <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                                   href="#tableCollapseProduct" role="button"
                                   aria-expanded="false" aria-controls="tableCollapse">Product zoeken</a>
                            </p>
                            <div class="tableCollapseProduct">
                                <div class="collapse multi-collapse" id="tableCollapseProduct">
                                    <div class="card card-body" style="padding:0px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-fixed"  id="tableCollapseProduct" >
                                                    <thead>
                                                    <tr>
                                                        <th class="col-md-2">Select</th>
                                                        <th class="col-md-2">Productnr</th>
                                                        <th class="col-md-3">Productnaam</th>
                                                        <th class="col-md-1">Prijs</th>
                                                        <th class="col-md-4">Opmerkingen</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbodyProduct">
                                                    <?php $discountController->GetAllProducts(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                                   href="#tableCollapseCategorie" role="button"
                                   aria-expanded="false" aria-controls="tableCollapse">Categorie zoeken</a>
                            </p>
                            <div class="tableCollapseCategorie">
                                <div class="collapse multi-collapse" id="tableCollapseCategorie">
                                    <div class="card card-body" style="padding:0px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-fixed"  id="tableCollapseCategorie" >

                                                    <thead>
                                                    <tr>
                                                        <th class="col-md-2">Select</th>
                                                        <th class="col-md-2">CategorieNr</th>
                                                        <th class="col-md-8">Omschrijving</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbodyCategorie">
                                                    <?php $discountController->GetAllCategoriesForAttachments(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-5 control-label" for="alternateText">Alternatieve Tekst:</label>
                                <input class="col-4 form-control" type="text" name="alternateText" id="alternateText"
                                       value="<?php echo($attachment->getAlternateText()) ?>">
                            </div>
                            <div class="form-group">
                                <label class="col-md-3" for="AttachmentID">Afbeelding</label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                        <input type="submit" name="submit" value="Media aanpassen" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>



<?php
include_once 'content/backend/footer-admin.php';

?>