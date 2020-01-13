<?php
include 'loader.php';
$admin = new controller\AdminController();
//include 'admin_scripts.php';

?>
<div class="col-12 col-md-3 col-lg-2 sidebarStyle">
    <div class="sidenav">
        <?php echo $admin->nav_menu_side(); ?>
    </div>
</div>