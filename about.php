<?
session_start(); 
include('fonction.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - A propos</title>
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
	<div class="hero-unit">
		<div class="ac">
			<h1>Rencontrez notre hos'team ou <a href="contact.html">Rencontrez nous</a>.</h1>
		</div>
	</div>

	<div id="team-members">
		
		<div class="row">

		<article class="member span4">
			<div class="member-avatar">
				<img alt="" class="thumbnail" src="img/team_member_1.png" />
			</div>
			<p class="member-networks">
				<a href="#" class="icon-twitter"></a>
				<a href="#" class="icon-linkedin"></a>
				<a href="#" class="icon-facebook"></a>
				<a href="#" class="icon-google-plus"></a>
				<a href="#" class="icon-phone"></a>
				<a href="#" class="icon-envelope"></a>
			</p>
			<h3 class="member-name">Thomas Nizet</h3>
			<h4 class="member-position">Le boss</h4>
			<p class="member-bio">
				Il ne fait rien de la journée et nous regarde comme un agent de la DDE. Oui c'est lui le boss
			</p>
		</article>

		<article class="member span4">
			<div class="member-avatar">
				<img alt="" class="thumbnail" src="img/team_member_3.png" />
			</div>
			<p class="member-networks">
				<a href="#" class="icon-twitter"></a>
				<a href="#" class="icon-linkedin"></a>
				<a href="#" class="icon-github"></a>
				<a href="#" class="icon-pinterest"></a>
			</p>
			<h3 class="member-name">Guillaume Jolaine</h3>
			<h4 class="member-position">le troll</h4>
			<p class="member-bio">
				Il ne fait que troller les autres dès qu'il le peut. Oui c'est lui le troll
			</p>
		</article>	

		<article class="member span4">
			<div class="member-avatar">
				<img alt="" class="thumbnail" src="img/team_member_2.png" />
			</div>
			<p class="member-networks">
				<a href="#" class="icon-facebook"></a>
				<a href="#" class="icon-phone"></a>
				<a href="#" class="icon-envelope"></a>
			</p>
			<h3 class="member-name">Cédric Boone</h3>
			<h4 class="member-position">Le belge</h4>
			<p class="member-bio">
				Il est plus rapide qu'un poisson rouge et dit des phrases sensées. Oui c'est lui le belge
			</p>
		</article>

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