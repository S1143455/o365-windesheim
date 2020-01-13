<?php
    include_once 'content/backend/header-admin.php';
    use Model\Category;

if (isset($_POST['id'])) {
    $categoryID = $_POST['id'];
    if($categoryID != 0){
        $category = $categoryController->retrieveCategory($categoryID);
        echo "<script type='text/javascript'> $(document).ready(function(){ $('#EditCategorieDialog').modal('show');   }); </script>";
    }
}

?>

<div class="container" style="width:100%">
    <div class="row">
<?php
    include_once 'content/backend/sidebar-admin.php';
?>

<div class="col-md-8">
    <div class="row" style="min-height: 50px;">
        <div class="col-md-12">
        <h3>
            Onderhoud Categorieën
        </h3>
        <br>
        </div>
    </div>
    <div class="row" style="min-height: 50px;">
        <div class="col-md-12">
            <input class="form-control" id="myInput" onkeyup="searchbar()" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search">
        </div>

    </div>
    <div class="row">
        <div class="col-12 col-md-10 col-lg-9 tableDiscount">
        <form role="form" id="table" method="POST" action="">
            <div class="table-fixed">
                <table class="table table-bordered" id="categoryTable">
                <thead>

                    <tr>
                        <th class="col-md-2">manage</th>
                        <th class="col-md-2">Categorie ID</th>
                        <th class="col-md-5">Omschrijving</th>
                        <th class="col-md-3">Parent Categorie</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $categoryController->GetAllCategories(); ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<div class="col-md-2">
    <div class="row">
        <button type="button" class="first discountButton btn btn-success" data-toggle="modal" data-target="#createCategory">
            Aanmaken Categorie
        </button>
    </div>
</div>

<!--  modals      -->
<div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="CreateModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateCategorie" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span>Aanmaken <span class="modal-title">Categorie</span></h4>

                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                </div>
                <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                    <span class="alert-body"></span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3" for="categoryID">Categorie</label>
                        <input type="text" class="col-md-5 form-control" name="CategoryName" id="CategoryName">
                    </div>
                    <div class="form-group">
                        <br>
                        <label for="attachment">Afbeeldingen</label>
                        <input style="width: 100%;" type="file" class="form-control" name="attachmentIMG[]" multiple id="attachmentIMG[]" >
                        <br>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3" for="categoryID">Ouder Categorie</label>
                        <select class="col-md-4 form-control" name="ParentCategory">
                            <option value="None">Empty</option>
                            <?php $categoryController->ParentCategories() ?>
                        </select>
                    </div>
                    <p>
                        <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                           href="#tableCollapseProduct" role="button"
                           aria-expanded="false" aria-controls="tableCollapse">Kortingscode zoeken</a>
                    </p>
                    <div class="tableCollapseProduct">
                        <div class="collapse multi-collapse" id="tableCollapseProduct">
                            <div class="card card-body">
                                <input class="form-control collapseTableSearch" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search" id="myInputProduct">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-fixed tableCollapseSP" id="tableCollapsespecialdeal">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-2">Select</th>

                                                    <th class="col-md-4">Korting omschrijving</th>
                                                    <th class="col-md-2">korting's percentage</th>
                                                    <th class="col-md-4">Korting actief</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyProduct">
                                                <?php $categoryController->GetAllDiscountsForcategorie(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" value="Aanmaken" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="EditCategorieDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="CreateCategorie" method="POST" action="CreateCategorie">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                </div>


                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>


                        <input type="text" class="form-control" name="CategoryID" id="CategoryID" value="<?php echo($category->getCategoryID()) ?>" >
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName" value="<?php echo($category->getCategoryName()) ?>" >
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="LastEditedBy" id="LastEditedBy" value="<?php echo($category->getLastEditedBy()) ?>" >
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="ParentCategory" id="ParentCategory" value="<?php echo($categoryController->getParentCategoryfromCategory($category)) ?>"  >
                    </div>
                    <div class="col-md-12">
                        <br>
                        <label for="attachment">Afbeeldingen</label>
                        <input style="width: 100%;" type="file" class="form-control" name="attachmentIMG[]" multiple id="attachmentIMG[]" >
                        <br>
                    </div>

                    <p>
                        <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                           href="#tableCollapseProduct" role="button"
                           aria-expanded="false" aria-controls="tableCollapse">Kortingscode veranderen</a>
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
                                               id="tableCollapsespecialdeal">
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
                                            <?php $categoryController->GetAllDiscountsForActiveCategorie($category); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" value="Aanpassen" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>


</div>
<script>

    // $(document).on("click", ".open-EditDialog", function () {
    //     alert("hoi");
    //     var myBookId = $(this).data('id');
    //
    //
    // });



    function searchbar() {
        var input, filter, table, tr, tds, i, txtValue, tdsearch;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("categoryTable");
        tr = table.getElementsByTagName("tr");

        if(filter == ''){
            for (i = 1; i < tr.length; i++) {
                    tr[i].style.display = "";
            }
        }

        for (i = 1; i < tr.length; i++) {
            tdsearch = false;
            tds = tr[i].getElementsByTagName("td");
            for(x = 0; x < tds.length; x++){
                if (tds[x]) {
                    txtValue = tds[x].textContent || tds[x].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tdsearch = true;
                    }
                }
            }
            if(tdsearch == false){
                tr[i].style.display = "none";
            }
        }
    }
</script>
<?php
include_once 'content/backend/footer-admin.php';
?>