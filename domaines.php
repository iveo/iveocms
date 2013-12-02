<?php
session_start(); 
include("fonction.php")
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Domaines</title>
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
<?php
include("header.php");
?>
	<!-- Content
	================================================== -->
	<div id="content" class="container">
	<div class="hero-unit">
		<div class="ac">
			<h1>Domaines</h1>
			<p>Reservez ici votre nom de domaine</p>
		</div>
	</div>
<?php
echo "<center>";
	echo "<table class='table table-bordered'>";
		echo "<thead>";
			echo "<tr>";
				echo "<th>Extension</th>";
				echo "<th>Année</th>";
				echo "<th>Prix d'achat</th>";
				echo "<th>Renouvelement</th>";
				echo "<th>Tranfert</th>";
				echo "<th>Commander</th>";
			echo "</tr>";
		echo "</thead>";
	include("sql.php");
	$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
	mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
	mysql_query("SET NAMES 'utf8'");
	
			$sql =" SELECT *
					FROM hostime_domaine
					ORDER BY ext ASC";			
		$req = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
		while ($data = mysql_fetch_assoc($req) )
		{
		// on affiche les informations de l'enregistrement en cours
		echo "<tbody>";
			echo "<tr>";
				echo "<td rowspan='2'>".$data['ext']."</td>";
				echo "<td>".$data['annee']."</td>";
				echo "<td>".$data['achat']." Euros</td>";
				echo "<td>".$data['renouv']." Euros</td>";
				echo "<td>".$data['trans']." Euros</td>";
				echo "<td><a href=\"commandes.php?dom=".$data['id']."\" class='btn btn-warning'>Commander</a></td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		mysql_close();
	echo "</center>";
?>     
	</div>

<?php
include("footer.php");
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