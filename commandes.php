<?
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', '1');
	include('fonction.php');
	include('sql.php');
	include('refresh.php');
	
	if(!isset($_SESSION['user']) || $_SESSION['user'] == '')
	{
		redirect('login.php?error=1&red='.(isset($_GET['offre']) ? 'hebergement' : 'domaines').'', 0);
		
	}
	
	/* if(isset($_SESSION['user']) && $_SESSION['user'] != '')
	{
		$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");

		$sql = "SELECT * FROM hostime_users WHERE id = ".$_SESSION['id']."";
		$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		
		while($data = mysql_fetch_assoc($req))
		{
			// $h_name[$data['id']] = $data['nom'];
			$name = $data['user'];
			$mail = $data['email'];
			$tokens = $data['tokens'];
			// $id = $data['id'];
			$root = $data['root'];
		}
		
		// setcookie('id', $id, time() + 1*12*3600, null, null, false, true);
		setcookie('user', $name, time() + 1*12*3600, null, null, false, true);
		setcookie('mail', $mail, time() + 1*12*3600, null, null, false, true);
		setcookie('tokens', $tokens, time() + 1*12*3600, null, null, false, true);
		setcookie('co', "true", time() + 1*12*3600, null, null, false, true);
		setcookie('root', ($root == 1 ? true : false), time() + 1*12*3600, null, null, false, true);
		
		mysql_close();

	} */
	
	// require_once( 'api/whm.class.php' );
	
	
	
	$h_name = array();
	// $h_dom = array();
	// $h_dom_prix = array();
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
	
	// $sql = "SELECT * FROM hostime_domaine ORDER BY ext ASC";
	// $req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	
	// while($data = mysql_fetch_assoc($req))
	// {
		// $h_dom[$data['id']] = $data['ext'];
		// $h_dom_prix[$data['id']] = $data['prix'];
	// }
	
	mysql_close();
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Commandes</title>
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
	
	<script TYPE="text/javascript">
		<!--
		// copyright 1999 Idocs, Inc. http://www.idocs.com
		// Distribute this script freely but keep this notice in place
		function letternumber(e)
		{
		var key;
		var keychar;

		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		keychar = keychar.toLowerCase();

		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) )
		   return true;

		// alphas and numbers
		else if ((("abcdefghijklmnopqrstuvwxyz0123456789").indexOf(keychar) > -1))
		   return true;
		else
		   return false;
		}
		//-->
		</script>
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
			<h1 class="ac">Commande d'un hébergement web ou d'un domaine</h1>
			<p class="ac">
				Commandez votre hébergement ou votre domaine depuis cette page. L'activation des hébergements web est automatique.
							</p>
		</div>
	</div>

	<?
	
	if(isset($_GET['offre']))
	{
		$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");

		$_GET['offre'] = mysql_real_escape_string(htmlspecialchars($_GET['offre']));
		$sql = 'SELECT * FROM hostime_hebergement WHERE id=\'' . $_GET['offre'] . '\' ORDER BY id ASC';
		$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		
		$offre = "??";
		$prix = "??";
		
		while($data = mysql_fetch_assoc($req))
		{
			// $h_dom[$data['id']] = $data['ext'];
			// $h_dom_prix[$data['id']] = $data['prix'];
			// echo '<a href="index.php?dom='.$id.'" class="btn btn-warning">'.$name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
			// echo '';
			// print_r($data);
			// echo '';
			$offre = $data['nom'];
			$prix = $data['prix'];
		}
		
		mysql_close();
			
		echo '<div id="offre_conf" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Confirmer mon achat - Offre '.$offre.' à '.$prix.' tokens</h3>
		  </div>
		  <div class="modal-body">
			<form method="post" action="#">
			
				<label for="dom_h">Sous-Domaine: </label><input type="text" name="dom_h" onKeyPress="return letternumber(event)">.hostime.eu<br /><i>Caractère alphanumérique</i><br /><br />
				<input type="submit" value="Oui" name="final_ans" class="btn" /> &nbsp;&nbsp;
				<input type="submit" value="Non" name="final_ans" class="btn" />
			
			</form>
		</div>
		  <div class="modal-footer">
			Veuillez confirmer.
		  </div>
		</div>';
		if(isset($_POST['final_ans']))
		{
			if(isset($_POST['dom_h']) && $_POST['dom_h'] != '')
			{
				if($_POST['final_ans'] == "Non")
				{
					redirect('commandes.php?offre='.$_GET['offre'].'', 0);
					die();
				}
				else if($_POST['final_ans'] == "Oui")
				{
					$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
					mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
					mysql_query("SET NAMES 'utf8'");

					
					$_GET['offre'] = mysql_real_escape_string(htmlspecialchars($_GET['offre']));
					$sql = 'SELECT * FROM hostime_hebergement WHERE id=\'' . $_GET['offre'] . '\' ORDER BY id ASC';
					$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
					
					$offre = "??";
					$prix = "??";
					
					while($data = mysql_fetch_assoc($req))
					{
						// $h_dom[$data['id']] = $data['ext'];
						// $h_dom_prix[$data['id']] = $data['prix'];
						// echo '<a href="index.php?dom='.$id.'" class="btn btn-warning">'.$name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
						// echo '';
						// print_r($data);
						// echo '';
						$offre = $data['nom'];
						$prix = $data['prix'];
					}
					
					$sql = "SELECT * FROM hostime_users_hebergement WHERE domaine = '".$_POST['dom_h']."' ORDER BY id ASC";
					$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
					
					$fail = false;
					
					while($data = mysql_fetch_assoc($req))
					{
						$fail = true;
					}
					
					if($fail)
					{
						echo '<center><b style="color:red;">ERREUR: Sous-domaine déjà pris</b><br />Redirection dans 5 secondes ...</center>';
						redirect('commandes.php?offre='.$_GET['offre'].'', 5);
						// die();
					}
					else
					{
						if($prix != 0)	echo 'Achat de l\'hebergement '.$offre.' à '.$prix.' tokens, veuillez patienter ...<br /><br />';
						else
							echo '<div class="alert alert-success">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  <h4>Requête envoyée</h4>
									  Votre reqête d\'hebergement a bien été prise en compte, un administrateur s\'occupera de votre demande sous peu ...
									</div>';
						
						if($offre != '??' && $prix != '??' && $_SESSION['tokens'] >= $prix)
						{
							if($prix == 0)
							{
								$sql = "SELECT * FROM hostime_hebergement_file WHERE user = '".$_SESSION['user']."' ORDER BY id ASC";
								$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
								
								$fail = false;
								$active = -1;
								while($data = mysql_fetch_assoc($req))
								{
									$fail = true;
									$active = $data['validated'];
								}
							
								if(!$fail)
								{
									// $sql = "UPDATE hostime_users SET tokens = tokens-".$prix." WHERE id = ".$_SESSION['id']."";
									// mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
									
									$sql = "INSERT INTO hostime_hebergement_file (stamp, user, userid, sousdom) VALUES(UNIX_TIMESTAMP(), '".$_SESSION['user']."', ".$_SESSION['id'].", '".$_POST['dom_h']."')";
									mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
								}
								else
								{
									// echo '<div class="alert alert-error">ERREUR: Vous possédez déjà un hébergement gratuit '. ($active == 0 ? 'en cours d\'activation (validation par administrateur) ' : ''). '!</div>';
									echo '<div class="alert alert-error">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  <h4>Erreur</h4>
									  Vous possédez déjà un hébergement gratuit '. ($active != 1 ? 'en cours d\'activation (validation par administrateur) ' : ''). '!
									</div>';
								}
							}
						}
					}
				}
				else
					echo '<b style="color:red;">Erreur !</b>';
					
				mysql_close();
			}
			else
			{
				echo '<center><b style="color:red;">ERREUR: Vous devez notifier un sous-domaine</b><br />Redirection dans 5 secondes ...</center>';
				redirect('commandes.php?offre='.$_GET['offre'].'', 5);
			}
			
		}
		// else if(isset($_POST['conf1']))
		// {
			// echo '<center><b>Etes-vous sûr ?</b><br />
			// <form method="post" action="#">
			// <input type="submit" value="Oui" name="final_ans" class="btn" /> &nbsp;&nbsp;
			// <input type="submit" value="Non" name="final_ans" class="btn" />
			
			// </form>
			
			// </center>';
			
		// }
		else
		{
			echo '<a href="commandes.php" class="btn btn-primary">Retour</a><br /><br />';
			// echo 'ITS OK !';
			$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");

			
			$_GET['offre'] = mysql_real_escape_string(htmlspecialchars($_GET['offre']));
			$sql = 'SELECT * FROM hostime_hebergement WHERE id=\'' . $_GET['offre'] . '\' ORDER BY id ASC';
			$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
			while($data = mysql_fetch_assoc($req))
			{
				// $h_dom[$data['id']] = $data['ext'];
				// $h_dom_prix[$data['id']] = $data['prix'];
				// echo '<a href="index.php?dom='.$id.'" class="btn btn-warning">'.$name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
				// echo '';
				// print_r($data);
				echo '
				<h2>Confirmer mon achat - commande d\'hébergement</h2><br />
				Nom: <div class="btn btn-warning">'.$data['nom'].'</div><br /><br />
				Prix: <div class="btn">'.$data['prix'].' € soit '.$data['prix'].' tokens</div> pour '.($data['duree'] == 0 ? '1 mois' : '1 an').' <br /><br /><br />
				'.($_SESSION['tokens'] >= $data['prix'] ? 
				
				'<a href="#offre_conf" role="button" class="btn btn-large btn-success" data-toggle="modal"">Confirmer</a>'
				// '<form method="post" action="#offre_conf">
				// <input type="hidden" name="conf1" />
				// <!-- <input type="submit" class="btn" value="Confirmer" /> !-->
				// <input type="submit" class="btn btn-large btn-success" value="Confirmer" />
				// </form>'

				: 
				'<div class="btn btn-danger">Tokens insuffisant ('.$_SESSION['tokens'].')</div>');
			}
			
			mysql_close();
		}
	}
	else if(isset($_GET['dom']))
	{
		
		if(isset($_POST['final_ans']))
		{
			if($_POST['final_ans'] == "Non")
			{
				redirect('commandes.php?dom='.$_GET['dom'].'', 0);
			}
			else if($_POST['final_ans'] == "Oui")
			{
				$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
				mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
				mysql_query("SET NAMES 'utf8'");

				$ext_buy="??";
				
				$_GET['dom'] = mysql_real_escape_string(htmlspecialchars($_GET['dom']));
				$sql = 'SELECT * FROM hostime_domaine WHERE id=\'' . $_GET['dom'] . '\' ORDER BY id ASC';
				$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				
				while($data = mysql_fetch_assoc($req))
				{
					$ext_buy = $data['ext'];
				}
				
				mysql_close();
			
				echo 'Achat du domaine '.$_POST['nom_dom'].'.'.$ext_buy.' ...';
			}
		}
		else if(isset($_POST['conf1']))
		{
			$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");

			$ext_buy="??";
			
			$_GET['dom'] = mysql_real_escape_string(htmlspecialchars($_GET['dom']));
			$sql = 'SELECT * FROM hostime_domaine WHERE id=\'' . $_GET['dom'] . '\' ORDER BY id ASC';
			$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
			while($data = mysql_fetch_assoc($req))
			{
				$ext_buy = $data['ext'];
			}
			
			mysql_close();
				
			echo '<center><b>Etes-vous sûr ?</b><br /><br />
			
			'.$_POST['nom_dom'].$ext_buy.'
			<br />
			<br />
			<form method="post" action="#">
			<input type="submit" value="Oui" name="final_ans" class="btn" /> &nbsp;&nbsp;
			<input type="submit" value="Non" name="final_ans" class="btn" />
			<input type="hidden" value="'.$_POST['nom_dom'].'" name="nom_dom"/>
			
			</form>
			
			</center>';
		}
		else
		{
			echo '<a href="commandes.php" class="btn btn-primary">Retour</a><br /><br />';
			// echo 'ITS OK !';
			// echo 'ITS OK !';
			$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");

			
			$_GET['dom'] = mysql_real_escape_string(htmlspecialchars($_GET['dom']));
			$sql = 'SELECT * FROM hostime_domaine WHERE id=\'' . $_GET['dom'] . '\' ORDER BY id ASC';
			$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
			while($data = mysql_fetch_assoc($req))
			{
				// $h_dom[$data['id']] = $data['ext'];
				// $h_dom_prix[$data['id']] = $data['prix'];
				// echo '<a href="index.php?dom='.$id.'" class="btn btn-warning">'.$name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
				// echo '';
				// print_r($data);
				echo '
				<h2>Confirmer mon achat - commande de domaine</h2><br />
				Nom: <div class="btn btn-warning">'.$data['ext'].'</div><br /><br />
				Prix: <div class="btn">'.$data['achat'].' € soit '.$data['achat'].' tokens</div> <br /><br /><br />
				'. 
				($_SESSION['tokens'] >= $data['achat'] ? '<form method="post" action="#"><input type="hidden" name="conf1" /><label for="nom_dom">Nom de domaine</label><input type="text" name="nom_dom" />'.$data['ext'].' &nbsp; <input type="submit" class="btn" value="Confirmer" /></form>' : '<div class="btn btn-danger">Tokens insuffisant ('.$_SESSION['tokens'].')</div>');
			}
			
			mysql_close();
		}
	}
	else
	{
		echo '<br />';
		echo '<br />';
		echo '<br />';
		// echo '<b style="color:red;">Une erreur est survenue ! Veuillez recommencer</b>';
		// echo '<h2>Séléctionnez un plan d\'hebergement</h2>';
		// foreach($h_name as $id => $name)
		// {
			// echo '<a href="index.php?offre='.$id.'" class="btn btn-warning">'.$name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
		// }
		?>
		
		<table class="table table-condensed">
				<caption><h2>Hebergements Disponibles</h2><br /></caption>
				<thead>
					<tr>
					<th>Nom</th>
					<th>Prix</th>
					<th>Période</th>
					<th>Action</th>
					</tr>
				</thead>
				<tbody>
		
		<?
		
		$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");

		
		$sql = "SELECT * FROM hostime_hebergement ORDER BY id ASC";
		$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		
		while($data = mysql_fetch_assoc($req))
		{
			// $h_dom[$data['id']] = $data['ext'];
			// $h_dom_prix[$data['id']] = $data['prix'];
			// echo '<a href="index.php?dom='.$id.'" class="btn btn-warning">'.$name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
			echo '
			
			<tr>
			<td><div class="btn btn-warning">'.$data['nom'].'</div></td>
			<td>'.$data['prix'].' €</td>
			<td>'.($data['duree'] == 0 ? '1 mois' : '1 an').'</td>
			<td><a href="commandes.php?offre='.$data['id'].'" class="btn btn-primary">Commander</td>
			
			</tr>
			
			';
		}
		
		mysql_close();
		
		// echo '<h1>OU</h1><h2>Un domaine</h2><br />';
		
		?>
		
		<table class="table table-condensed">
				<caption><h2>Domaines Disponibles</h2><br /></caption>
				<thead>
					<tr>
					<th>Nom</th>
					<th>Prix</th>
					<th>Période</th>
					<th>Action</th>
					</tr>
				</thead>
				<tbody>
		
		<?
		
		
		$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");

		
		$sql = "SELECT * FROM hostime_domaine ORDER BY ext ASC";
		$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		
		while($data = mysql_fetch_assoc($req))
		{
			// $h_dom[$data['id']] = $data['ext'];
			// $h_dom_prix[$data['id']] = $data['prix'];
			// echo '<a href="index.php?dom='.$id.'" class="btn btn-warning">'.$name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
			echo '
			
			<tr>
			<td><div class="btn btn-warning">'.$data['ext'].'</div></td>
			<td>'.$data['achat'].' €</td>
			<td>'.$data['annee'].' an'.($data['annee'] > 1 ? 's' : '').'</td>
			<td><a href="commandes.php?dom='.$data['id'].'" class="btn btn-primary">Commander</td>
			
			</tr>
			
			';
		}
		
		mysql_close();
	}
	?>
	</tbody>
	</table>
	
	</div>
	<br />
	<br />
	<br />
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
