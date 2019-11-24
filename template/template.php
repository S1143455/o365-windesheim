<?php
include 'loader.php';
$database = new Classes\Database();
$authentication = new Classes\Authentication($database);
$user = new Classes\User($database);


?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <title><?php $main->page_title(); ?> | <?php $main->site_name(); ?></title>
	    <link href="<?php $main->site_url(); ?>/template/style.css" rel="stylesheet" type="text/css" />
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
    			<div class="col align-self-center">
					<header>
				        <h1><?php $main->site_name(); ?></h1>
				        <nav class="menu">
				            <?php $main->nav_menu();

                                echo $user->isAuthenticated();
				            ?>

				        </nav>
				    </header>
				</div>
			</div>
			
		  	<div class="row">
			    <div class="col-sm">
			      	<article>
		        		<h2><?php $main->page_title(); ?></h2>
		        		<?php $main->page_content(); ?>
		    		</article>
			    </div>
			</div>
			<div class="row">
			     <footer>
		        <small>&copy;<?php echo date('Y'); ?> <?php $main->site_name(); ?>.<br><?php $main->site_version(); ?></small>
			    </footer>

		    </div>  		
		</div>
	</body>
</html>