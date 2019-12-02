<?php
include 'loader.php';
include 'admin_scripts.php';

$database = new Model\Database();
$authentication = new Controller\Authentication('users');
$user = new Controller\User($database);
$admin = new Controller\Admin();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $admin->page_title(); ?> | <?php echo $admin->site_name(); ?></title>
    <link href="<?php echo $main->template_path() ?>style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $main->template_path() ?>admin.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $main->template_path() ?>custom.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top  my-nav">
    <div class="container navcontainer">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bas-navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <img class="navbar-brand logo" src="./logo_omasbeste.png" alt="photo" ></img>
                    </div>
                    <div class="col-md-9 tekst">
                        <h1>Oma's beste</h1>
                        <h2>Producten zoals oma ze vroeger maakte! </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="hide1 scroll-nav">
                    <?php $admin->navigationalmenu(); ?>
                </div>
            </div>
        </div>
        <div class="row" style="height:1px;background-color:black;"> </div>
        <div class="row">
            <div class="col-md-8 normalnav">
                <?php $admin->navigationalmenu(); ?>
            </div>
        </div>
    </div>
</nav>
