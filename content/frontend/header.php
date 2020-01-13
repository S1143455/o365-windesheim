<?php
include 'loader.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $mainController->page_title(); ?> | <?php echo $mainController->site_name(); ?></title>
    <link href="<?php echo $mainController->template_path() ?>style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $mainController->template_path() ?>custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $mainController->template_path() ?>home.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-static navbar-collapse navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img class="navbar-brand logo" src="./logo_omasbeste.png" alt="photo">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 tekst">
                <h1>Oma's beste</h1>
                <h2>Producten zoals oma ze vroeger maakte! </h2>
            </div>
            <div class="col-md-10 hide1 scroll-nav">
                <?php $mainController->navigationalmenu(); ?>
            </div>
            <div class="col-md-2 hide1 scroll-nav">
                <?php $mainController->ShoppingCartMenu(); ?>
            </div>
            <div class="col-md-10 normalnav">
                <?php $mainController->navigationalmenu(); ?>
            </div>
            <div class="col-md-2 normalnav">
                <?php $mainController->ShoppingCartMenu(); ?>
            </div>
        </div>
    </div>
</nav>

<div class="">