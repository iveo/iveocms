<?
session_start(); 
		include('fonction.php');
		include('sql.php');
		
		$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");
		
		$sql =mysql_query("SELECT * FROM hostime_config") or die(mysql_error());
		$config = mysql_fetch_array($sql);
		
		mysql_close();
	?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Hébergement</title>
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
		<div class="container">
			<h1 class="ac">UN HÉBERGEMENT ADAPTÉ À TOUS !</h1>
			<p class="ac">
				Comme chacun n'a pas les mêmes besoins, Hostime vous propose différentes offres d'hébergement adaptées à tous ! De 500 Mo a 50 Go vous pourrez stocker vos Maps, vos SourcesTV et votre site. Nous restons a votre disposition pour toute question.
							</p>
		</div>
	</div>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Information</h4>
  Nous proposons une offre gratuite que vous pouvez retrouver <a href="#gratuite" role="button" data-toggle="modal">ici</a>.
</div>
<br><br>
	<!-- Example pricing -->
	<div class="row pricing">


		<div class="span4">
			<div class="well">
				<h2>Standard</h2>
				<ul>
					<li>15 Go d'espace disque</li>
                            <li>Bande passante <b>illimitée</b></li>
                            <li>Comptes FTP <b>illimités</b> </li>
                            <li>Bases de données <b>illimitées</b></li>
                            <li>Comptes E-mail <b>illimités</b></li>
                            <li>Sous domaines <b>illimités</b></li>
                            <li>3 Domaines additionnels</li>
                            <li>cPanel 11 : <font color="green">&#10004;</font></li>
                            <li>Nom de domaine gratuit* : <font color="red">&#10008;</font></li>
                            <li>Support VIP : En option**</li>
				</ul>
				<p>Le plan adapté aux petites "Teams" venant de commencer. Un petit prix avec un espace disque suffisant pour depart. </p>
				<hr />
				<h3 class="ac">1€ / mois</h3>
				<h4 class="ac">(1 Token)</h4>
				<hr />
				<p class="ac">
					<a class="btn btn-success btn-large" href="commandes.php?offre=2">Commander &raquo;</a>
				</p>
			</div>
		</div>
		<div class="span4 most-popular">
			<div class="well">
				<h2>Premium</h2>
				<p><span>POPULAIRE</span></p>
				<ul>
					<li>25 Go d'espace disque</li>
                            <li>Bande passante <b>illimitée</b></li>
                            <li>Comptes FTP <b>illimités</b> </li>
                            <li>Bases de données <b>illimitées</b></li>
                            <li>Comptes E-mail <b>illimités</b></li>
                            <li>Sous domaines <b>illimités</b></li>
                            <li><b>3</b> Domaines additionnels</li>
                            <li>cPanel 11 : <font color="green">&#10004;</font></li>
                            <li>Nom de domaine gratuit* : <font color="green">&#10004;</font></li>
                            <li>Support VIP : En option**</li>
				</ul>          
				<p>Le plan le plus populaire de nos offres ! Avec un nom de domaine offert* et un espace disque large vous pouvez héberger de nombreuses maps. Votre support sous 24H maxiumum ! </p>
				<hr />
				<h3 class="ac">2€ / mois</h3>
				<h4 class="ac">(2 Tokens)</h4>
				<hr />
				<p class="ac">
					<!-- <a class="btn btn-success btn-large" href="commandes.php?offre=3">Commander &raquo;</a> !-->
					<a href="#offre3" role="button" class="btn btn-large btn-success" data-toggle="modal">Commander &raquo;</a>
				</p>
				<div id="offre3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Premium ou Premium+</h3>
				  </div>
				  <div class="modal-body">
				<center><a href="commandes.php?offre=3" class="btn btn-warning">Premium (2 €) - 1 mois</a>  <a href="commandes.php?offre=4" class="btn btn-warning">Premium+ (22 €) - 1 an</a></center>
				</div>
				  <div class="modal-footer">
					Choisissez l'offre de votre choix !
				  </div>
				</div>
				
			</div>
		</div>
		<div class="span4">
			<div class="well">
				<h2>Best'ime</h2>
				<ul>
					<li>50 Go d'espace disque</li>
                            <li>Bande passante <b>illimitée</b></li>
                            <li>Comptes FTP <b>illimités</b> </li>
                            <li>Bases de données <b>illimitées</b></li>
                            <li>Comptes E-mail <b>illimités</b></li>
                            <li>Sous domaines <b>illimités</b></li>
                            <li><b>10</b> Domaines additionnels</li>
                            <li>cPanel 11 : <font color="green">&#10004;</font></li>
                            <li>Nom de domaine gratuit* : <font color="green">&#10004;</font></li>
                            <li>Support VIP : <font color="green">&#10004;</font></li>
				</ul>          
				<p>Pour des "Teams" PRO. Une réponse sous 12H maximum ! Et 50 Go pour stocker Maps, SourcesTV, et de nombreux scripts.</p>
				<hr />
				<h3 class="ac">3€ / mois</h3>
				<h4 class="ac">(3 Tokens)</h4>
				<hr />
				<p class="ac">
					<!-- <a class="btn btn-success btn-large" href="commandes.php?offre=5">Commander &raquo;</a> !-->
					<a href="#offre5" role="button" class="btn btn-large btn-success" data-toggle="modal">Commander &raquo;</a>
				</p>
				<div id="offre5" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Best'ime ou Best'ime+</h3>
				  </div>
				  <div class="modal-body">
				<center><a href="commandes.php?offre=5" class="btn btn-warning">Best'ime (3 €) - 1 mois</a>  <a href="commandes.php?offre=6" class="btn btn-warning">Best'ime+ (34 €) - 1 an</a></center>
				</div>
				  <div class="modal-footer">
					Choisissez l'offre de votre choix !
				  </div>
				</div>
			</div>
		</div>
		</div>
		
		<br><font size="1">* Nom de domaine gratuit pour le paiement annuel d'une des offres compatibles.
                <br>** Support VIP : Réponse par ticket sous 12 Heures (douze heures) maximum. Offert dans l'offre Best'ime. <br>&nbsp; &nbsp; En option payante (1 token/an) dans les offres Standard & Premium. Non disponible pour l'offre gratuite.</font>

	

	<hr />


	</div>
	
	<div id="gratuite" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Notre offre gratuite</h3>
  </div>
  <div class="modal-body">
  
  <?php if ($config['gratuite'] == "1")
  {

?>



		
			<div class="well">
				<center><h2>Basique</h2></center>
				<ul>
							<li>500 Mo d'espace disque</li>
                            <li>5 Go de bande passante</li>
                            <li>1 Compte FTP</li>
                            <li>1 Base de donnée</li>
                            <li>1 Compte E-mail</li>
                            <li>1 Sous domaine</li>
                            <li>0 Domaines additionnels</li>
                            <li>cPanel 11 : <font color="green">&#10004;</font></li>
                            <li>Nom de domaine gratuit* : <font color="red">&#10008;</font></li>
                            
				</ul>
				
				<center><span class="label label-warning"><font size="3">Activation manuelle du compte<br>GRATUIT</font></span></center>
				
				<br>
				<p class="ac">
					<a class="btn btn-success btn-large" href="commandes.php?offre=1">Commander &raquo;</a>
				</p>
			</div>
		
		
<?php
}
else
{
?>
fuck
<?php
}
?>
	
</div>
 
</div>     

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
