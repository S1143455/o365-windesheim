<?php
include 'loader.php';
$database = new Model\Database();
$authentication = new Controller\AuthenticationController();
$user = new Controller\UserController();


?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <title><?php echo $main->page_title(); ?> | <?php echo $main->site_name(); ?></title>
	    <link href="<?php echo $main->template_path() ?>style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $main->template_path() ?>custom.css" rel="stylesheet" type="text/css" />
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
    			<div class="col align-self-center">
					<header>
				        <h1><?php echo $main->site_name(); ?></h1>
				        <nav class="menu">
				            <?php echo $main->nav_menu();

                                echo $user->isAuthenticated();
				            ?>

				        </nav>
				    </header>
				</div>
			</div>
			
		  	<div class="row">
			    <div class="col-sm">
			      	<article>
		        		<h2><?php echo $main->page_title(); ?></h2>

		    		</article>
			    </div>
			</div>
			<div class="row">
			     <footer>
		        <small>&copy;<?php echo date('Y'); ?> <?php echo $main->site_name(); ?>.<br><?php echo $main->site_version(); ?></small>
			    </footer>

		    </div>  		
		</div>
	</body>
</html>