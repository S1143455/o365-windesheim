<?php
include_once 'content/backend/header-admin.php';

use Model\Discount;

if (isset($_POST['id'])) {
    $discountID = $_POST['id'];
    if ($discountID != 0) {
        $discount = $discountController->retrieve($discountID);
        $discount->getSpecialDealID();
        echo "<script type='text/javascript'> $(document).ready(function(){ $('#EditDiscountDialog').modal('show');   }); </script>";
    }

}

?>
<div class="container-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="row">

        <?php
        include_once 'content/backend/sidebar-admin.php';
        ?>

        <div class="col-12 col-md-9 col-lg-10">
            <!--dit gaat in header -->
            <h3>
                Onderhoud Korting
            </h3>
            <br>
            <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
            <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?"
                   aria-label="Search" id="myInput">
            <br>
            <div class="row">
                <div class="col-12 col-md-10 col-lg-9 tableDiscount">
                    <!-- Creates a table with headers and data based on function -->
                    <form role="form" id="table" method="POST" action="">
                        <div class="table-fixed">
                            <table class="table table-bordered" id="tableViewDiscount">
                                <thead>
                                <tr>
                                    <th class="col-md-1">Manage</th>
                                    <th class="col-md-2">Code</th>
                                    <th class="col-md-1">Percentage</th>
                                    <th class="col-md-1">Eenmalig</th>
                                    <th class="col-md-1">Actief</th>
                                    <th class="col-md-3">Omschrijving</th>
                                    <th class="col-md-1">Product aantal</th>
                                    <th class="col-md-1">Beginperiode</th>
                                    <th class="col-md-1">Eindperiode</th>
                                </tr>
                                </thead>
                                <tbody id="tbodyCustomer">
                                <?php $discountController->GetAllDiscount(); ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <!-- style="" -->

                <div class="col-12 col-md-2 col-lg-2 discountButtons">
                    <!-- discount option buttons  -->
                    <button type="button" class="discountButton btn btn-success" data-toggle="modal"
                            data-target="#oneTimeDiscount">
                        Eenmalige korting
                    </button>
                    <button type="button" class="discountButton btn btn-success" data-toggle="modal"
                            data-target="#DiscountProduct">
                        Korting op product(en)
                    </button>
                    <button type="button" class="discountButton btn btn-success" data-toggle="modal"
                            data-target="#DiscountCategory">
                        Korting op categorie(ën)
                    </button>
                    <button type="button" class="discountButton btn btn-success" data-toggle="modal"
                            data-target="#MailDiscount">
                        Korting mailen naar klant
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal (popup) OneTimeDiscount -->
<div class="modal fade" id="oneTimeDiscount" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Eenmalige korting aanmaken</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="col-12">
                            <div class="row">
                                <label class="col-5 control-label" for="inputCodeOT">Code:</label>
                                <input class="col-7 form-control inputCode" type="text" name="DealCode" id="inputCodeOT"
                                       placeholder="Code">
                            </div>
                            <div class="row">
                                <div class="col-5"></div>
                                <button class="col-7 btn btn-outline-secondary btnGenerateCode" type="button"
                                        onclick="generateCodeOT();">Genereer code
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-5 control-label" for="checkboxOT">Eenmalig:</label>
                            <input class="checkboxOneTime" type="checkbox" name="OneTime" id="OneTime"
                                   value="1">
                        </div>
                        <div class="form-group">
                            <label class="col-5 control-label descriptionPopUp"
                                   for="descriptionOT">Omschrijving:</label>
                            <textarea class="col-7 form-control dealDescription" name="DealDescription"
                                      id="descriptionOT" rows="3" placeholder="Omschrijving"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-5 control-label" for="inputPercentageOT">Percentage:</label>
                            <input class="col-2 form-control inputPercentage" type="text" name="DiscountPercentage"
                                   id="inputPercentageOT">
                            <span class="col-1 symbolPercentage">%</span>
                        </div>
                        <div class="form-group">
                            <label class="col-5 control-label" for="StartDate">Begin periode:</label>
                            <input class="col-4 form-control inputStartDate" type="date" name="StartDate"
                                   id="StartDate">
                        </div>
                        <div class="form-group">
                            <label class="col-5 control-label" for="EndDate">Einde periode:</label>
                            <input class="col-4 form-control inputEndDate" type="date" name="EndDate"
                                   id="EndDate">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="submit">Korting aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal (popup) korting op product -->
<div class="modal fade" id="DiscountProduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Korting op product(en)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                           href="#tableCollapseProduct" role="button"
                           aria-expanded="false" aria-controls="tableCollapse">Product zoeken</a>
                    </p>
                    <div class="tableCollapseProduct">
                        <div class="collapse multi-collapse" id="tableCollapseProduct">
                            <div class="card card-body">
                                <input class="form-control collapseTableSearch" type="text"
                                       placeholder="Waar ben je naar op zoek?"
                                       aria-label="Search" id="myInputProduct">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-fixed tableCollapseSP"
                                               id="tableCollapseProduct">
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

                    <div class="form-group">
                        <div class="col-12">
                            <div class="row">
                                <label class="col-5 control-label" for="inputCodePD">Code:</label>
                                <input class="col-7 form-control inputCode" type="text" name="DealCode" id="inputCodePD"
                                       placeholder="Code">
                            </div>
                            <div class="row">
                                <div class="col-5"></div>
                                <button class="col-7 btn btn-outline-secondary btnGenerateCode" type="button"
                                        onclick="generateCodeDP();">Genereer code
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-5 control-label" for="checkboxDP">Eenmalig:</label>
                        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxDP">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label descriptionPopUp"
                               for="descriptionDP">Omschrijving:</label>
                        <textarea class="form-control dealDescription" name="DealDescription"
                                  id="descriptionDP" rows="3" placeholder="Omschrijving"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label labelInputPercentage"
                               for="inputPercentageDP">Percentage:</label>
                        <input class="col-2 form-control inputPercentage" type="text" name="DiscountPercentage"
                               id="inputPercentageDP">
                        <span class="col-1 symbolPercentage">%</span>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label labelInputStartDate" for="StartDate">
                            Begin periode:</label>
                        <input class="col-4 form-control inputStartDate" type="date" name="StartDate"
                               id="StartDate">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="EndDate">Einde periode:</label>
                        <input class="col-4 form-control inputEndDate" type="date" name="EndDate"
                               id="EndDate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="submit" value="deze tael">Korting aanmaken
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal (popup) korting op categorie -->
<div class="modal fade" id="DiscountCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Korting op categorie(ën)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                           href="#tableCollapseCategory"
                           role="button"
                           aria-expanded="false" aria-controls="tableCollapseCategory">Categorie zoeken</a>
                    </p>
                    <div class="tableCollapseCategory">
                        <div class="collapse multi-collapse" id="tableCollapseCategory">
                            <div class="card card-body">
                                <input class="form-control collapseTableSearch" type="text"
                                       placeholder="Waar ben je naar op zoek?"
                                       aria-label="Search" id="myInputCategory">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-fixed tableCollapseSP "
                                               id="tableCollapseProduct">
                                            <thead>
                                            <tr>
                                                <th class="col-md-2">Select</th>
                                                <th class="col-md-2">Categorie nr</th>
                                                <th class="col-md-4">Categorie naam</th>
                                                <th class="col-md-2">Parent Categorie</th>
                                                <th class="col-md-2">Gekoppelde korting id</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbodyCategory">
                                            <?php $discountController->GetAllCategories(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <label class="col-5 control-label" for="inputCodeDC">Code:</label>
                            <input class="col-7 form-control inputCode" type="text" name="DealCode" id="inputCodeDC"
                                   placeholder="Code">
                        </div>
                        <div class="row">
                            <div class="col-5"></div>
                            <button class="col-7 btn btn-outline-secondary btnGenerateCode" type="button"
                                    onclick="generateCodeDC();">Genereer code
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="checkboxDP">Eenmalig:</label>
                        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxDP">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label descriptionPopUp"
                               for="descriptionDC">Omschrijving:</label>
                        <textarea class="col-7 form-control dealDescription" name="DealDescription"
                                  id="descriptionDC" rows="3" placeholder="Omschrijving"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label labelInputPercentage"
                               for="inputPercentageDC">Percentage:</label>
                        <input class="col-2 form-control inputPercentage" type="text" name="DiscountPercentage"
                               id="inputPercentageDC">
                        <span class="col-1 symbolPercentage">%</span>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label labelInputStartDate" for="StartDate"> Begin periode:
                        </label>
                        <input class="col-4 form-control inputStartDate" type="date" name="StartDate"
                               id="StartDate">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="EndDate">Einde periode:</label>
                        <input class="col-4 form-control inputEndDate" type="date" name="EndDate"
                               id="EndDate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="submit">Korting aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal (popup) korting mailen naar klant -->
<div class="modal fade" id="MailDiscount" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Korting mailen naar klant</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <div class="row">
                                <label class="col-5 control-label" for="inputCodeMD">Code:</label>
                                <input class="col-7 form-control inputCode" type="text" name="DealCode" id="inputCodeMD"
                                       placeholder="Code">
                            </div>
                            <div class="row">
                                <div class="col-5"></div>
                                <button class="col-7 btn btn-outline-secondary btnGenerateCode" type="button"
                                        onclick="generateCodeMD();">Genereer code
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="checkboxMD">Eenmalig:</label>
                        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxMD">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label descriptionPopUp"
                               for="descriptionMD">Omschrijving:</label>
                        <textarea class="col-7 form-control dealDescription" name="DealDescription"
                                  id="descriptionMD" rows="3" placeholder="Omschrijving"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label labelInputPercentage"
                               for="inputPercentageMD">Percentage:</label>
                        <input class="col-2 form-control inputPercentage" type="text" name="DiscountPercentage"
                               id="inputPercentageMD">
                        <span class="col-1 symbolPercentage">%</span>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label labelInputStartDate"
                               for="StartDate">Begin periode:</label>
                        <input class="col-4 form-control " type="date" name="StartDate"
                               id="StartDate">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="EndDate">Einde periode:</label>
                        <input class="col-4 form-control inputEndDate" type="date" name="EndDate"
                               id="EndDate">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="inputEmail">Email:</label>
                        <input class="col-7 form-control inputEmail" type="email" id="inputEmail" placeholder="Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="submit">Korting aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal to edit selected discount -->
<div class="modal fade" id="EditDiscountDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="EditDiscount" method="POST" action="UpdateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Korting aanpassen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                           href="#tableCollapseProduct" role="button"
                           aria-expanded="false" aria-controls="tableCollapse">Product zoeken</a>
                    </p>
                    <div class="tableCollapseProduct">
                        <div class="collapse multi-collapse" id="tableCollapseProduct">
                            <div class="card card-body">
                                <input class="form-control collapseTableSearch" type="text"
                                       placeholder="Waar ben je naar op zoek?"
                                       aria-label="Search" id="myInputEditProduct">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-fixed tableCollapseSP "
                                               id="tableCollapseProduct">
                                            <thead>
                                            <tr>
                                                <th class="col-md-2">Select</th>
                                                <th class="col-md-2">Product nr</th>
                                                <th class="col-md-3">Productnaam</th>
                                                <th class="col-md-1">Prijs</th>
                                                <th class="col-md-4">Opmerkingen</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbodyEditProduct">
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
                           href="#tableCollapseCategory"
                           role="button"
                           aria-expanded="false" aria-controls="tableCollapseCategory">Categorie zoeken</a>
                    </p>
                    <div class="tableCollapseCategory">
                        <div class="collapse multi-collapse" id="tableCollapseCategory">
                            <div class="card card-body">
                                <input class="form-control collapseTableSearch" type="text"
                                       placeholder="Waar ben je naar op zoek?"
                                       aria-label="Search" id="myInputEditCategory">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-fixed tableCollapseSP "
                                               id="tableCollapseProduct">
                                            <thead>
                                            <tr>
                                                <th class="col-md-1">Select</th>
                                                <th class="col-md-2">Categorie nr</th>
                                                <th class="col-md-4">Categorie naam</th>
                                                <th class="col-md-2">Parent Categorie</th>
                                                <th class="col-md-2">Gekoppelde korting id</th>

                                            </tr>
                                            </thead>
                                            <tbody id="tbodyEditCategory">
                                            <?php $discountController->GetAllCategories(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="col-5" for="SpecialDealID">SpecialDealID:</label>
                        <input class="col-4 form-control" type="text" name="SpecialDealID" id="SpecialDealID"
                               value="<?php echo($discount->getSpecialDealID()) ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-5" for="DealCode">Code:</label>
                        <input class="col-4 form-control" type="text" name="DealCode" id="DealCode"
                               value="<?php echo($discount->getDealCode()) ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="checkboxOT">Eenmalig:</label>
                        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxOT"
                               value="<?php echo($discount->getOneTime()) ?>
                    </div>
                    <div class=" form-group">
                        <label class="col-5" for="categoryID">Omschrijving:</label>
                        <textarea class="col-7 form-control dealDescription" name="DealDescription" id="DealDescription"
                                  rows="3"><?php echo($discount->getDealDescription()) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="inputPercentageOT">Percentage:</label>
                        <input class="col-2 form-control inputPercentage" type="text" name="DiscountPercentage"
                               id="inputPercentageOT"
                               value="<?php echo($discount->getDiscountPercentage()) ?>">
                        <span class="col-1 symbolPercentage">%</span>
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="StartDate">Begin periode:</label>
                        <input class="col-4 form-control inputStartDate" type="date" name="StartDate"
                               id="StartDate"
                               value="<?php echo($discount->getStartDate()) ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-5 control-label" for="EndDate">Einde periode:</label>
                        <input class="col-4 form-control inputEndDate" type="date" name="EndDate"
                               id="EndDate"
                               value="<?php echo($discount->getEndDate()) ?>">
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

<?php
include_once 'content/backend/footer-admin.php';

?>
<!-- scripts to generate a random code for each modal-->
<script xmlns:line-height="http://www.w3.org/1999/xhtml">
    function generateCodeOT() {
        var x = document.getElementById("inputCodeOT")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeDP() {
        var x = document.getElementById("inputCodeDP")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeDC() {
        var x = document.getElementById("inputCodeDC")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeMD() {
        var x = document.getElementById("inputCodeMD")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }
</script>

<script>
    $('#StartDate').date({minDate: 0});
</script>

<!--<script>-->
<!--    $('#StartDate').date({-->
<!--        pickTime: false,-->
<!--        icons: {-->
<!--            time: "fa fa-clock-o",-->
<!--            date: "fa fa-calendar",-->
<!--            up: "fa fa-arrow-up",-->
<!--            down: "fa fa-arrow-down"-->
<!--        },-->
<!--        minDate: moment()-->
<!--    });-->
<!--</script>-->

<!-- script to search data in tableViewCustomer using the searchbar-->
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tbodyCustomer tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<!-- script to search data in tableViewProduct using the searchbar-->
<script>
    $(document).ready(function () {
        $("#myInputProduct").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tbodyProduct tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<!-- script to search data in tableViewCategory using the searchbar-->
<script>
    $(document).ready(function () {
        $("#myInputCategory").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tbodyCategory tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<!-- script to search data in edit tableViewProduct using the searchbar-->
<script>
    $(document).ready(function () {
        $("#myInputEditProduct").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tbodyEditProduct tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<!-- script to search data in edit tableViewCategory using the searchbar-->
<script>
    $(document).ready(function () {
        $("#myInputEditCategory").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tbodyEditCategory tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


<script>
    $('.load-modal').on('click', function (e) {
        e.preventDefault();
        $('#createDiscount').modal('show');
    });
</script>

<?php
include_once 'content/backend/footer-admin.php';

?>