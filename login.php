<? 
session_start(); 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', '1');
include('fonction.php');
include('sql.php');


$page = array(

	'index',
	'hebergement',
	'commandes',
	'domaines',
	'contact',
	'about',
	'ucp',
	'wiki/',
	'tokens'

);

if(isset($_POST['login']) && isset($_POST['pwd']))
{
	$_POST['login'] = mysql_escape_string($_POST['login']);
	$_POST['pwd'] = mysql_escape_string($_POST['pwd']);
	
	$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
	mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
	mysql_query("SET NAMES 'utf8'");
		
	$_POST['pwd'] = md5($_POST['pwd']);
	
	$sql = "SELECT * FROM hostime_users WHERE user = '". $_POST['login'] ."' AND pwd = '". $_POST['pwd'] ."'";
	$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	
	$co = false;
	while($data = mysql_fetch_assoc($req))
	{
		$co = true;
		$name = $data['user'];
		$mail = $data['email'];
		$tokens = $data['tokens'];
		$id = $data['id'];
		$root = $data['root'];
		$vip = $data['vip'];
		$sus = $data['suspendu'];
		// $mail = $data['email'];
	}
	
	// echo 'Co : -> ' . ($co == true ? 'ON' : 'OFF') . ' User = ' . $_POST['login'] . ' & pwd = ' . $_POST['pwd'];
	
	if($co)
	{
		// echo '<b style="color:green;">Connexion réussie !</b>';
		$_SESSION['user'] = $name;
		$_SESSION['mail'] = $mail;
		$_SESSION['tokens'] = $tokens;
		$_SESSION['co'] = true;
		$_SESSION['vip'] = $vip;
		$_SESSION['suspendu'] = $sus;
		$_SESSION['id'] = $id;
		$_SESSION['root'] = ($root == 1 ? true : false);
		// setcookie('id', $id, time() + 1*12*3600, null, null, false, true);
		// setcookie('user', $name, time() + 1*12*3600, null, null, false, true);
		// setcookie('mail', $mail, time() + 1*12*3600, null, null, false, true);
		// setcookie('tokens', $tokens, time() + 1*12*3600, null, null, false, true);
		// setcookie('co', "true", time() + 1*12*3600, null, null, false, true);
		// setcookie('root', ($root == 1 ? true : false), time() + 1*12*3600, null, null, false, true);
		
		$sql = "UPDATE hostime_users SET ip = '".$_SERVER['REMOTE_ADDR']."', last_co = UNIX_TIMESTAMP() WHERE id = ".$id." LIMIT 1";
		mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	}
	else
	{
		session_destroy();
	}
	// else	echo '<b style="color:red;">Connexion échouée !</b><br /><a href="login.php">Réessayer</a>';
		
	mysql_close();
	
	$page_red = "index.php";
	
	if(isset($_GET['red']))
	{
		foreach($page as $name)
		{
			if($name == $_GET['red'])
			{
				$page_red = $name . '.php';
			}
		}
	}
	
	
	// header('Location: ' . $page_red);
	redirect('index.php', 0);
	// users
}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Login</title>
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
<?

include('header.php');

?>
	<div class="container">
<br><br><br><br><br>
		<h2>Connexion</h2>

		<div class="well">

	
	<?
	if(isset($_SESSION['user']) && $_SESSION['user'] != '')
	{
		echo '<div <div class="alert alert-warning">
  
  <h4>Attention !</h4>
  Vous êtes déjà connecté ! <br> <a href="index.php">Retour au site </a>
</div> ';
	}
	// else
	// {
		// echo '<p>Connexion en cours ...</p>';
	
	else
	{
	
	
	if(isset($_GET['error']) && $_GET['error'] == 1)
	{
		echo '<div <div class="alert alert-error">
		  <h4>Erreur !</h4>
		  Vous devez être connecté pour continuer !</a>
		</div>';
	}
	?>
	
	
	
			<center><br><br><br><br>	<fieldset>

		  <form action="#" method="post">
			<div class="input-prepend">
  					<span class="add-on"><i class="icon-user"></i></span>
			<input type="text" name="login" placeholder="Identifiant" required />
			</div>
			<br>
			<div class="input-prepend">
  					<span class="add-on"><i class="icon-lock"></i></span>
			<input type="password" name="pwd" placeholder="Mot de passe" required />
			</div>
<br><br>
			<button type="submit" class="btn btn-primary">Connexion</button>
			
			<hr />
			<!-- <span class="help-block">Copyright &copy; 2012 Hostime.eu</span> !-->
			
		  </form>

		</fieldset></center>
		
	  
	  

	
	
	<? } 
	
	?>
	

</div> <!-- /container -->
</div> <!-- /container -->
<br />
<br />
<br />
<?

include('footer.php');

?>
	
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="js/jquery.touchSwipe.js"></script>
	<script type="text/javascript" src="js/jquery.hotkeys.min.js"></script>
	<script type="text/javascript" src="js/functions.min.js?v=2"></script>
</body>
</html>
