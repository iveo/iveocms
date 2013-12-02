<?
session_start(); 
include('fonction.php');
include('sql.php');

if(!isset($_SESSION['user']) || $_SESSION['user'] == '')
{
	redirect('login.php?error=1&red=ucp', 0);
	die();
}

$showm = 0;

if(isset($_POST['mail']))
{
	$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
	mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
	mysql_query("SET NAMES 'utf8'");
	if($_POST['mail'] == '')
	{
		// echo '<b style="color:red;">ERREUR aucun champs ne peut être vide</b>';
		$showm = 2;
	}
	else
	{
		// $_POST['user'] = mysql_escape_string($_POST['user']);
		$_POST['mail'] = mysql_escape_string($_POST['mail']);
		// $_POST['name'] = mysql_escape_string($_POST['name']);
		// $_POST['prenom'] = mysql_escape_string($_POST['prenom']);
		
		$sql = "";
		
		// if($_POST['user'] != $_SESSION['user'])
		// {
			// if($sql != '')	$sql .= ' AND ';
			// $sql .= "user = '".$_POST['user']."'";
		// }
		if($_POST['mail'] != $_SESSION['mail'])
		{
			if($sql != '')	$sql .= ' AND ';
			$sql .= "email = '".$_POST['mail']."'";
		}
		
		if($sql != '')
		{
			
			$sql = "UPDATE hostime_users SET " . $sql . " WHERE id = ".$_SESSION['id']." LIMIT 1";
			// $sql = "UPDATE hostime_users SET user LIMIT 1";
			// echo $sql;
			mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
			// setcookie('mail', $_POST['mail']
			$_SESSION['mail'] = $_POST['mail'];
			setcookie('mail', $_POST['mail'], time() + 1*24*3600, null, null, false, true);
			
			$showm = 1;
			
			echo 'showm = ' . $showm;
		}
		// echo '<b style="color:green;">Profil mis à jour</b>';
		
		
		// echo '<div class="alert alert-success">
		  // <button type="button" class="close" data-dismiss="alert">&times;</button>
		  // <h4>Profil édité</h4>
		  // Profil édité avec succès
		// </div>';
	}
	mysql_close();
}


?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - UCP</title>
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
	
	<div class="container">
	
	
	
	<?
	
	if(isset($_GET['page']) && $_GET['page'] == "info")
	{
		// $edit = false;
		if(isset($_GET['action']) && $_GET['action'] == "editmyprofile")
		{
			// $edit = true;
			echo '
			<br />
			<br />
			<h1>Panel de contrôle de l\'utilisateur</h1> <a href="ucp.php?page=info" class="btn btn-primary">Retour</a><br />
			<br />
			<h2>Mes informations</h2>
			<p>
			<form method="POST" action="ucp.php?page=info">
			Nom d\'utilisateur '.$_SESSION['user'].'<br /><br />
			<label for="mail">Adresse électronique</label><input type="email" name="mail" value="'. $_SESSION['mail'].'" /><br /><br />
			Tokens: '. $_SESSION['tokens'].'<br />
			<i>----------------------------------</i><br /><br />
			
			';
		
			$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");

			
			$sql = "SELECT * FROM hostime_users WHERE id = ".$_SESSION['id']."";
			
			$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
			while($data = mysql_fetch_assoc($req))
			{
				echo 'Nom et Prénom '.$data['nom'].' '.$data['prenom'].'<br /><br />';
				echo 'Inscription le: ' . $data['inscription'] . '<br /><br />';
				// echo 'Toke';
				echo 'Etat du compte: ' .($data['vip'] == 0 ? 'Non VIP' : 'VIP') . '<br /><br />';
			}
			
			mysql_close();
		?>
			<br /><input type="submit" class="btn btn-primary" value="Valider" />
			</form>
			<?
		}
		else
		{
	?>
		<br />
			<br />
		<h1>Panel de contrôle de l'utilisateur</h1> <a href="ucp.php" class='btn btn-primary'>Retour</a><br />
		<br />
		<h2>Mes informations</h2>
		
		<?
		
		if($showm == 1)
		{
			echo '<div class="alert alert-success">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <h4>Profil édité</h4>
		  Profil édité avec succès
		</div>';
		}
		else if($showm == 2)
		{
			// echo 'show = ' .$showm;
			echo '<div class="alert alert-error">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <h4>Erreur</h4>
		  Aucun champs ne peut être vide
		</div>';
		}

			
			
		?>
		
		<p>
		Nom d'utilisateur : <? echo $_SESSION['user']; ?><br /><br />
		Adresse électronique : <? echo $_SESSION['mail']; ?><br /><br />
		Tokens: <? echo $_SESSION['tokens']; ?><br /><br />
		<i>----------------------------------</i><br /><br />
		<?
		
			$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");
			
			$sql = "SELECT * FROM hostime_users WHERE id = ".$_SESSION['id']."";
			
			$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
			while($data = mysql_fetch_assoc($req))
			{
				echo 'Nom et Prénom: '.$data['nom'].' '.$data['prenom'].'<br /><br />';
				echo 'Inscription le: ' . $data['inscription'] . '<br /><br />';
				// echo 'Toke';
				echo 'Etat du compte: ' .($data['vip'] == 0 ? 'Non VIP' : 'VIP') . '<br /><br />';
			}
			
			mysql_close();
		?>
			<br /><a href="ucp.php?page=info&action=editmyprofile" class="btn btn-warning">Editer mes informations</a>
		<?
		}
	}
	
else if(isset($_GET['page']) && $_GET['page'] == "vip")
	{
	if($_SESSION['vip'] == 1) {
	?>
	<div class="hero-unit">
		<div class="container">
			<h1 class="ac">Devenir VIP</h1>
			<p class="ac">
				Grâce a votre VIP vous disposez de nombreux avantages !
							</p>
		</div>
	</div>
	
	<br><br>
	<div class="alert alert-info">
			  <h4>Info VIP</h4>
				Vous êtes déjà VIP. Vous vous remercions de votre confiance.
			</div>
	
	<?php
}
else
{
?>
<div class="hero-unit">
		<div class="container">
			<h1 class="ac">Devenir VIP</h1>
			<p class="ac">
				Grâce a votre VIP vous disposez de nombreux avantages !
							</p>
		</div>
	</div>
	
	<br><br>
	<div class="alert alert-info">
			  <h4>Info VIP</h4>
				Vous n'êtes pas encore VIP. 
			</div>

	
	

	

	<?
	}
	}
	else if(isset($_GET['page']) && $_GET['page'] == "offres")
	{
	?>
	
		<br />
		<br />
		<h1>Panel de contrôle de mes hébergements</h1> <a href="ucp.php<? if(isset($_GET['action'])) echo '?page=offres'; ?>" class='btn btn-primary'>Retour</a><br />
		<br />
		
		<?
		if(isset($_GET['action']))
		{
			if($_GET['action'] == "admin" && isset($_GET['id']) && $_GET['id'] != '')
			{
				$infos = array();
				$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
				mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
				mysql_query("SET NAMES 'utf8'");
				
				$sql = "SELECT * FROM hostime_users_hebergement WHERE user_id = ".$_SESSION['id']." AND id = ".$_GET['id']."";
				$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				
				$fail = true;
				while($data = mysql_fetch_assoc($req))
				{
					$fail = false;
					$infos = $data;
				}
				
				mysql_close();
				
				if(!$fail)
				{
					// echo 'ok <br />';
					// print_r($infos);
					// echo '';
					echo '<h2>Administration du service #'.$infos['id'].' - <a href="http://'.$infos['domaine'].'">'.$infos['domaine'].'</a></h2><br />';
					
					
					echo '<a href="'.$infos['cpanel'].'" class="btn btn-warning">Accéder au cpanel</a><br />';
					echo '<br />';
					echo '<a href="ucp.php?page=offres&action=delete&id='.$infos['id'].'" class="btn btn-warning">Supprimer mon hebergement</a><br />';
				}
				else
				{
					echo '<b>ERREUR !</b>';
				}
			}
			else if($_GET['action'] == "delete" && isset($_GET['id']) && $_GET['id'] != '')
			{
				$infos = array();
				$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
				mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
				mysql_query("SET NAMES 'utf8'");
				
				$sql = "SELECT * FROM hostime_users_hebergement WHERE user_id = ".$_SESSION['id']." AND id = ".$_GET['id']."";
				$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				
				$fail = true;
				while($data = mysql_fetch_assoc($req))
				{
					$fail = false;
					$infos = $data;
				}
				
				
				
				if(!$fail)
				{
					// echo 'ok <br />';
					// print_r($infos);
					// echo '';
					// echo '<h2>Administration du service #'.$infos['id'].' - <a href="http://'.$infos['domaine'].'">'.$infos['domaine'].'</a></h2><br />';
					
					
					// echo '<a href="'.$infos['cpanel'].'" class="btn btn-warning">Accéder au cpanel</a><br />';
					// echo '<br />';
					// echo '<a href="ucp.php?page=offres&action=delete&id='.$infos['id'].'" class="btn btn-warning">Supprimer mon hebergement</a><br />';
					if(!isset($_POST['ans']))
					{
					echo 'Confirmer la suppression du service ?';
					echo '
					<form method="post" action="#">
						<input type="submit" value="Oui" name="ans" />
						<input type="submit" value="Non" name="ans" />
		
					</form>';
					}
					else
					{
						// print_r($_POST);
						if($_POST['ans'] == "Non")
						{
							// header();
							redirect('ucp.php?page=admin&id='.$_GET['id'], 0);
						}
						else
						{
							$sql = "UPDATE hostime_users_hebergement SET user_id = 1 WHERE user_id = ".$_SESSION['id']." AND id = ".$_GET['id']." LIMIT 1";
							mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
							echo '<b style="color:orange;">Hebergement supprimé !</b>';
						}
					}
				}
				else
				{
					echo '<b>ERREUR !</b>';
				}
				mysql_close();
			}
			else
			{
				echo '<b>ERREUR !</b>';
			}
		}
		else
		{
		?>
		    <table class="table table-condensed">
				<caption><h2>Mes Hebergements</h2></caption>
				<thead>
					<tr>
					<th>#</th>
					<th>Type</th>
					<th>Nom</th>
					<th>Expiration</th>
					<th>Outils</th>
					</tr>
				</thead>
				<tbody>
					
					<?
					
						$h_name = array();
						// $h_ = array();
					
						$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
						mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
						mysql_query("SET NAMES 'utf8'");

						$sql = "SELECT * FROM hostime_hebergement ORDER BY id ASC";
						$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						
						while($data = mysql_fetch_assoc($req))
						{
							$h_name[$data['id']] = $data['nom'];
						}
						
						$sql = "SELECT * FROM hostime_users_hebergement WHERE user_id = ".$_SESSION['id']."";
						$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						
						while($data = mysql_fetch_assoc($req))
						{
							// $h_name[$data['id']] = $data['name'];
							echo '<tr>
							<td>'.$data['id'].'</td>
							<td>'.$h_name[$data['offre_id']].'</td>
							<td>'.$data['domaine'].'</td>
							<td>'.date("d/m/Y", $data['expire']).'</td>
							<td><a href="ucp.php?page=offres&action=admin&id='.$data['id'].'" class="btn btn-warning">Administrer</a></td>
							</tr>';
							// print_r($data);
							// echo '<br />';
						}
						
						mysql_close();
					
					?>
				</tbody>
			</table>
		<?
		}
		?>
	<?
	}
	else
	{
		?>
			<br />
			<br />
			<center style="font-size:100px;">
			<a href="ucp.php?page=info" class='btn btn-warning' style="font-size: 40px; line-height: 50px;"><b>Mon Profil</b></a>
			<a href="ucp.php?page=offres" class='btn btn-warning' style="font-size: 40px; line-height: 50px;"><b>Mes Hebergements</b></a>
			<br /><br />
			<a href="wiki" class='btn btn-warning' style="font-size: 40px; line-height: 50px;"><b>Hostime Wiki</b></a>
			</center>
		
		<?
	}
	?>
			<br />
			<br />
			<br />
	</p>
	
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