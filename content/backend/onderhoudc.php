<?php

include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';

?>
    <div class="container marginleft">
        <div class="row" style="min-height: 50px;">
            <div class="col-md-7">

            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-3">

            </div>
        </div>
        <div class="row">
            <div class="container">
                <table class="table table-fixed">
                    <thead>
                    <tr>
                        <th class="col-xs-3">First Name</th>
                        <th class="col-xs-3">Last Name</th>
                        <th class="col-xs-6">E-mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-xs-3">John</td>
                        <td class="col-xs-3">Doe</td>
                        <td class="col-xs-6">johndoe@email.com</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table table-dark table-hover tableFixHead">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">TH 1</th>
                            <th scope="col">TH 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $category->GetAllCategories(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">


        </div>

        Onderhoud Categorieën
        <p>This is <b>test</b> page.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
    </div>
<?php

include_once 'content/backend/footer-admin.php';

?>