<?php
include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';
?>
    <div class="container marginleft">
        <div class="row" style="min-height: 50px;"></div>
        <div class="row" style="min-height: 50px;">
            <div class="col-md-7">
                <input class="form-control" id="myInput" onkeyup="searchbar()" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search">
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <div class="row">
            <div class="container">
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
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3">

                <button class="btn btn-primary load-modal" href="editadminprofile.php?id='.$row['id'].'" data-toggle="modal" data-target="#myModal2" title="Click To View Orders">Edit Profile</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kortingEenmaal">
                    Eenmalige korting
                </button>
            </div>
        </div>
    </div>



    <div id="createCategory" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- HTML will be inserted here -->
            </div>
        </div>
    </div>



    <script>
        $('.load-modal').on('click', function(e){
            e.preventDefault();
            $('#createCategory').modal('show');
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
                console.log(tr[i]);
                tdsearch = false;
                tds = tr[i].getElementsByTagName("td");
                for(x = 0; x < tds.length; x++){
                    if (tds[x]) {
                        txtValue = tds[x].textContent || tds[x].innerText;
                        console.log(txtValue.toUpperCase());
                        console.log(filter);
                        console.log(txtValue.toUpperCase().indexOf(filter));

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