<?php
include 'loader.php';
$admin = new controller\AdminController();
include 'admin_scripts.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $admin->page_title(); ?> | <?php echo $admin->site_name(); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link href="<?php echo $main->template_path() ?>style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $main->template_path() ?>admin.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $main->template_path() ?>custom.css" rel="stylesheet" type="text/css" />

</head>
<body>
<nav class="navbar navbar-default navbar-static-top  my-nav">
    <div class="container navcontainer">
        <div class="row">
            <div class="col-md-2">
                <img style="max-height: 50px; max-width: 80px;" class="navbar-brand logo" src="../logo_omasbeste.png" alt="photo" >
            </div>
            <div class="col-md-8 normalnav">
                <?php $admin->navigationalmenu(); ?>
            </div>
        </div>
    </div>
</nav>
