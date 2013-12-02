<?
session_start(); 
include('fonction.php');
include('sql.php');
include('refresh.php');

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Accueil</title>
	<link type="images/ico" rel="shortcut icon" href="img/server.png" />
	<meta name="description" content="Page description">
	<meta name="author" content="Your name">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Custom css -->
	<link href="css/style.min.css" rel="stylesheet">

	<link href="css/font-awesome/font-awesome.css" rel="stylesheet">
	<!--[if IE 7]>
		<link href="css/font-awesome/font-awesome-ie7.css" rel="stylesheet">
	<![endif]-->

	<!-- Load Open sans from Google Font Directory -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery-1.8.3.min.js"%3E%3C/script%3E'))</script>
</head>
<body>

	<!-- Header
	================================================== -->
	
	<?
		include('header.php');
	?>
	
	<!-- Content
	================================================== -->
	<div id="content" class="container">
	</div>
	<div class="homepage">
	

	
	
	<div class="container">
	<div class="hero-unit">

		<!-- headin gtext -->
		<p class="ac">
			Bonjour et bienvenue sur le site hostime.eu. Vous etes plongé dans le monde du jeu vidéo et voulez obtenir un hébergement web de qualité ? Vous êtes au bon endroit !
		</p>

		<!-- Carousel -->	
		<div id="macbook_carousel">
			<div id="carousel" class="carousel slide" rel="carousel">
				<!-- Carousel items -->				
				<div class="carousel-inner">
					<div class="active item">
						<img src="images/center.jpg" alt="" />
					</div>
					<div class="item">
						<img src="images/geek.jpg" alt="" />
					</div>
					<div class="item">
						<img src="assets/carousel_3.gif" alt="" />
					</div>
				</div>
				<!-- Carousel navigation -->
				<a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
				<a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span8">
			<h1 class="lead">
				Pour vous connecter ou vous inscrire, rien de plus simple. Il vous suffit de sélectionner l'onglet "mon compte" et de choisir l'option recherchée !
			</h1>
		</div>
		<div class="span4">
			<h3 class="ac">Possibilité d'hébergement gratuit !</h3>
			<p class="ac">
				<a class="btn btn-large btn-primary" href="inscription.php" title=""><b>Inscrivez-vous !</b></a>
			</p>
		</div>
	</div>

	<hr />

	<div class="row">
		<div class="span4">
			<h2>Aidez-nous !</h2>
			<p><?
				include('dons.php');
			?></p>
	 	</div>
		<div class="span4">
			<h2><span class="grey">Know more</span> about us</h2>
			 <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			<p><a class="" href="#">Read more &raquo;</a></p>
		</div>
		<div class="span4">
			<h2><span class="grey">Meet</span> us</h2>
			<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
			<p><a class="" href="#">Read more &raquo;</a></p>
		</div>
	</div>

	</div>	</div>

	<?
		include('footer.php');
	?>

	<!-- Javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="js/jquery.touchSwipe.js"></script>
	<script type="text/javascript" src="js/jquery.hotkeys.min.js"></script>
	<script type="text/javascript" src="js/functions.min.js?v=2"></script>

</body>
</html>