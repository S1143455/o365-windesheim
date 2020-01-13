<?php
include 'loader.php';
//$admin = new controller\AdminController();
//include 'admin_scripts.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $admin->page_title(); ?> | <?php echo $admin->site_name(); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<!--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="<?php echo $mainController->template_path() ?>style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $mainController->template_path() ?>admin.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $mainController->template_path() ?>custom.css" rel="stylesheet" type="text/css" />

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="row">
        <div class="col-md-2">
            <img class="navbar-brand" style="max-height:80px; max-width:50px;" src="../logo_omasbeste.png" alt="photo" >
        </div>
        <div class="col-md-10">
            <?php $admin->navigationalmenu();?>
        </div>
    </div>
</nav>
