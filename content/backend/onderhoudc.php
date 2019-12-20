<?php
    include_once 'content/backend/header-admin.php';
    use Model\Category;
    $categoryid = 0;
    $category = $categoryController->retrieve(1123);
    var_dump($category);
    $categoryController->update($category)

?>
<div class="container" style="width:100%">
    <div class="row">
<?php
    include_once 'content/backend/sidebar-admin.php';
?>

<div class="col-md-8">
    <div class="row" style="min-height: 50px;"></div>
    <div class="row" style="min-height: 50px;">
        <div class="col-md-7">
            <input class="form-control" id="myInput" onkeyup="searchbar()" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search">
        </div>

    </div>
    <div class="row">
        <table id="categoryTable" class="table table-fixed">
            <thead>
            <tr>
                <th class="col-md-1">manage</th>
                <th class="col-md-2">Categorie ID</th>
                <th class="col-md-5">Omschrijving</th>
                <th class="col-md-2">Parent Categorie</th>
                <th class="col-md-2">Acties </th>
            </tr>
            </thead>
            <tbody>
                <?php $discount->GetAllCategories(); ?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-2">
    <div class="row">
        <button type="button" class="first discountButton btn btn-primary" data-toggle="modal" data-target="#createCategory">
            Aanmaken Categorie
        </button>
    </div>
</div>

<!--  modals      -->

<div class="modal fade" id="EditCategorieDialog" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="universalModalForm1" method="POST" action="CreateCategorie">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                </div>
                <div class="modal-body">

                    <p>some content</p>
                    <input style="display: none;" type="text" name="bookId" id="bookId" value=""/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" value="Aanmaken" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateCategorie">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span>Aanmaken <span class="modal-title">Categorie</span></h4>
                </div>
                <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                    <span class="alert-body"></span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Ouder Categorie</label>
                        <select class="form-control" name="ParentCategory">
                            <option value="None">Empty</option>
                            <?php $categoryController->ParentCategories() ?>
                        </select>
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

</div>
<script>

    $(document).on("click", ".open-EditDialog", function () {
        alert("hoi");
        var myBookId = $(this).data('id');
        $(".modal-body #bookId").val( myBookId );
        alert(myBookId);

    });



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