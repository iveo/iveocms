<?
session_start(); 
include('fonction.php');
include('sql.php');

if(isset($_SESSION['user']) && $_SESSION['user'] != '')
{
	redirect('index.php', 0);
	die();
}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Inscription</title>
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
	
	<br />
	<br />
	<br />
	<br />
	
	<center>
	
	<?
	if(
	isset($_POST['login']) &&
	isset($_POST['pwd']) &&
	isset($_POST['mail']) &&
	isset($_POST['ad']) &&
	isset($_POST['ad_2']) &&
	isset($_POST['ad_3'])
	
	)
	{
		// echo 'Tentative de création du compte ...<br />';
		
		$error = '';
		if( $_POST['login'] == '' || $_POST['pwd'] == '' ||  $_POST['mail'] == '' ||  $_POST['ad'] == '' ||  $_POST['ad_2'] == '' ||  $_POST['ad_3'] == '')
		{
			echo '<h3 style="color:red;">Erreur ! </h3><br />';
			$error = '';
			$a_name = array(
			'login' => 'Nom d\'utilisateur',
			'pwd' => 'Mot de passe',
			'mail' => 'Adresse électronique',
			'ad' => 'Pays',
			'ad_2' => 'Code Postal',
			'ad_3' => 'Adresse',
			'nom' => 'Nom',
			'prenom' => 'Prénom'
			);
			
			foreach($_POST as $name => $value)
			{
				if($value == '')	$error .= '<span style="color:red;">'.$a_name[$name].' manquant</span><br />';
			}
			
			echo $error;
			echo '<br /><a href="inscription.php">Retour à la page d\'inscription</a>';
		}
		else
		{
			// echo 'mysql';
			echo '<b>Tentative de création du compte ...</b><br />';
			
			$_POST['login'] = mysql_escape_string($_POST['login']);
			$_POST['pwd'] = mysql_escape_string($_POST['pwd']);
			$_POST['pwd'] = md5($_POST['pwd']);
			$_POST['mail'] = mysql_escape_string($_POST['mail']);
			$_POST['ad'] = mysql_escape_string($_POST['ad']);
			$_POST['ad_2'] = mysql_escape_string($_POST['ad_2']);
			$_POST['ad_3'] = mysql_escape_string($_POST['ad_3']);
			$_POST['nom'] = mysql_escape_string($_POST['nom']);
			$_POST['prenom'] = mysql_escape_string($_POST['prenom']);
			
			$sql = "SELECT * FROM hostime_users WHERE user = '".$_POST['login']."' OR email = '".$_POST['mail']."'";
			
			$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");

			$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
			$fail = false;
			$fail_type = "";
			
			while($data = mysql_fetch_assoc($req))
			{
				$fail = true;
				if($_POST['login'] == $data['user'])	$fail_type = "le nom d'utilisateur <i>".$_POST['login']."</i> est déjà utilisé par un autre utilisateur";
				if($_POST['mail'] == $data['email'])	$fail_type = "l'adresse électronique <i>".$_POST['mail']."</i> est déjà utilisés par un autre utilisateur";
			}
			
			// echo "Fail = " . ($fail == false ? 'OK' : 'FAIL');
			if($fail)
			{
				echo '<b style="color:red;">ERREUR !</b><br />';
				echo '<span style="color:red;">'.$fail_type.'</span>';
			}
			else
			{
				
				$sql = "INSERT INTO hostime_users 
				(user, pwd, email, last_co, nom, prenom, adresse, ip) 
				VALUES(
				'".$_POST['login']."', 
				'".$_POST['pwd']."', 
				'".$_POST['mail']."',
				UNIX_TIMESTAMP(),
				'".$_POST['nom']."',
				'".$_POST['prenom']."',
				'".$_POST['ad']." |-| ".$_POST['ad_2']." |-| ".$_POST['ad_3']."',
				'".$_SERVER['REMOTE_ADDR']."'
				)";
				mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				echo '<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Bravo !</h4>
  Création du compte utilisateur réussie !<br /><br /><a href="login.php">Connexion</a>
</div>';
			}
			
			mysql_close();
			
		}
	}
	else
	{
	?>
	<h1>Formulaire d'inscription</h1><br />
	
	<form method="POST" action="#">
	<div class="alert alert-info">
 
  <h4>Attention:</h4>
  Vos informations personnelles doivent être <b>valides</b>.<br />Ces informations ne seront jamais utilisé dans d'autre organisme que Hostime
</div>
		
		<br />
		<label for="login">Nom d'utilisateur</label><input type="text" name="login" /><br />
		<label for="pwd">Mot de passe</label><input type="password" name="pwd" /><br />
		<label for="mail">Adresse électronique</label><input type="email" name="mail" /><br /><br />
		
		<label for="prenom">Prénom</label><input type="text" name="prenom" /><br />
		<label for="nom">Nom</label><input type="text" name="nom" /><br />
		
		<label for="ad">Pays</label>
		<select name="ad" id="ad">
		   <option value=""></option>
		   <option value="France">France</option>
		   <option value="Belgique">Belgique</option>
		   <option value="Suisse">Suisse</option>
		   <option value="Canada">Canada</option>
		   <option value="Autre">Autre</option>
		</select>
		
		<label for="ad_2">Code Postal</label><input type="text" name="ad_2" /><br />
		<label for="ad_3">Adresse</label><input type="text" name="ad_3" /><br />
		
		<hr>
<input type="submit" value="Valider" class="btn btn-large" />
	
	</form>
	<?
	}
	?>
	
	</center>
	
	<br />
	<br />
	<br />
	<br />

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