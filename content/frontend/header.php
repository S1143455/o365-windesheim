<?php
include 'loader.php';
$database = new Model\Database();
$authentication = new Controller\Authentication('users');
$user = new Controller\User($database);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $main->page_title(); ?> | <?php echo $main->site_name(); ?></title>
    <link href="<?php echo $main->template_path() ?>style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $main->template_path() ?>custom.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<script type="text/javascript">

    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        var wscroll = $(this).scrollTop();
        if(wscroll > 100){
            $(".navbar").addClass("shrink-nav");
            $(".logo").addClass("shrink-logo");
            $(".tekst").addClass("hide1");
            $(".scroll-nav").removeClass("hide1");
            $(".normalnav").addClass("hide1");
            $(".my-nav").removeClass("navbar-static-top");
            $(".my-nav").addClass("navbar-fixed-top");



        }
        else{
            $(".my-nav").addClass("navbar-static-top");
            $(".my-nav").removeClass("navbar-fixed-top");

            $(".navbar").removeClass("shrink-nav");
            $(".logo").removeClass("shrink-logo");
            $(".tekst").removeClass("hide1");
            $(".scroll-nav").addClass("hide1");
            $(".normalnav").removeClass("hide1");

        }
    }
</script>
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
                    <?php $main->navigationalmenu(); ?>
                </div>
            </div>
        </div>
        <div class="row" style="height:1px;background-color:black;"> </div>
        <div class="row">
            <div class="col-md-8 normalnav">
                <?php $main->navigationalmenu(); ?>
            </div>
        </div>
    </div>
</nav>
