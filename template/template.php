<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <title><?php page_title(); ?> | <?php site_name(); ?></title>
	    <link href="<?php site_url(); ?>/template/style.css" rel="stylesheet" type="text/css" />
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
    			<div class="col align-self-center">
					<header>
				        <h1><?php site_name(); ?></h1>
				        <nav class="menu">
				            <?php nav_menu(); ?>
				        </nav>
				    </header>
				</div>
			</div>
			
		  	<div class="row">
			    <div class="col-sm">
			      	<article>
		        		<h2><?php page_title(); ?></h2>
		        		<?php page_content(); ?>
		    		</article>
			    </div>
			</div>
			<div class="row">
			     <footer>
		        <small>&copy;<?php echo date('Y'); ?> <?php site_name(); ?>.<br><?php site_version(); ?></small>
			    </footer>

		    </div>  		
		</div>
	</body>
</html>