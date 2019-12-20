<?php
include 'loader.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $mainController->page_title(); ?> | <?php echo $mainController->site_name(); ?></title>
    <link href="<?php echo $mainController->template_path() ?>style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $mainController->template_path() ?>custom.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
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
<div class="container" style=" width:100% !important; ">
    <div class="row">
        <div class="col align-self-center">

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
                                <?php $mainController->navigationalmenu();?>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height:1px;background-color:black;"> </div>
                    <div class="row">
                        <div class="col-md-8 normalnav">
                            <?php $mainController->navigationalmenu(); ?>
                        </div>
                    </div>
                </div>
            </nav>
                <div class="container">