<?php
    include_once 'content/backend/header-admin.php';
    use Model\Category;

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
                <th class="col-xs-2">CategoryID</th>
                <th class="col-xs-7">Omschrijving</th>
                <th class="col-xs-3">Parent Category</th>
            </tr>
            </thead>
            <tbody>
                <?php $categoryController->GetAllCategories(); ?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-2">
    <div class="row">
        <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#createCategory">
            Eenmalige korting
        </button>
    </div>
</div>

                <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:1000px;">
                        <div class="modal-content">
                            <form role="form" id="universalModalForm" method="POST" action="test">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Edit<span class="modal-title">.model-title</span></h4>
                                </div>
                                <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                                    <span class="alert-body"></span>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="categoryID">Category</label>
                                        <input type="text" class="form-control" name="CategoryName" id="CategoryName">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <input type="submit" name="submit" value="product" class="btn btn-primary">
                                </div>
            </form>
        </div>
    </div>
</div>

</div>
<script>
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