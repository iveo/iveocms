<?php
@session_start(); 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', '1');

	include('fonction.php');
	include('sql.php');
	
	$send = false;
	
	if(!isset($_SESSION['user']) || $_SESSION['user'] == '')
	{
		redirect('contact.php', 0);
	}
	// print_r($_POST);
	if((!empty($_POST['nom'])) and (!empty($_POST['ticket'])))
		{
		
			$db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");
			$sql="	INSERT INTO hostime_support_tickets
					(username, mail, sujet, detail, stamp, vip)
					VALUES('".$_SESSION['user']."','".mysql_escape_string($_POST['nom'])."', '$_POST[sujet]', '".mysql_escape_string($_POST['ticket'])."', UNIX_TIMESTAMP(), '".($_SESSION['vip'] == 1 ? 1 : 0)."')";	
			// mysql_query("SET NAMES 'utf8'");
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
			
			$send = true;
			
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
	<title>Hostime - Support</title>
	<link type="images/ico" rel="shortcut icon" href="img/server.png" />
	<meta name="Contact " content="Page de contact">
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
	
		<!-- Include the validator script-->
<script src="js/gen_validatorv4.js"
type="text/javascript"></script>

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
		<br><br>
	<?PHP if($_SESSION['vip'] == 1) { ?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Information</h4>
  Vous êtes VIP. Vous avez une réponse à vos questions sous 12 Heures maximum ! 
</div>
<?php
}
else
{
?>
<div class="alert alert-warning">
  <h4>Information</h4>
  Notre centre support est ouvert tous les jours. Une réponse sous 24 heures vous sera donnée. Pour devenir <b>VIP</b> et n'attendre que 12 Heures maximum cliquez <a href="ucp.php">ICI</a>.
</div>
<?php
}
?>
</div>

	
	<br />
	
	<?
	
	if(isset($_GET['action']) && $_GET['action'] == "close" && isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");
		
		$sql = "UPDATE hostime_support_tickets SET actif = 0 WHERE id = " . $_GET['id'] . " LIMIT 1";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
		
		mysql_close();
	}
	else if(isset($_GET['action']) && $_GET['action'] == "open" && isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");
		
		$sql = "UPDATE hostime_support_tickets SET actif = 1 WHERE id = " . $_GET['id'] . " LIMIT 1";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
		
		mysql_close();
	}
	
	if(isset($_GET['action']) && $_GET['action'] == "show" && isset($_GET['id']) && is_numeric($_GET['id']))
	{
	?>
	
	<div class="well" style="max-width: 800px; margin: 0 auto 10px;">
	
	<?
		$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");
		$sql =mysql_query("SELECT * FROM hostime_support_tickets WHERE id = " . $_GET['id']) or die(mysql_error());
		$verif = mysql_fetch_array($sql);
		
		// echo $verif['username'] . '<br />';
		// echo $_SESSION['user'];
		
		if($_SESSION['user'] != $verif['username'])
		{
			$lien = "support.php";
			redirect($lien, 0);
			mysql_close();
			die();
		}
		
		// $db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			// mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			// mysql_query("SET NAMES 'utf8'");
			
			if(isset($_POST['reponse']))
			{
				// $sql = "UPDATE hostime_support_tickets SET admin = '".$_SESSION['user']."', admin_stamp = UNIX_TIMESTAMP(), admin_rep = '".mysql_escape_string($_POST['reponse'])."'  WHERE id = " . $_GET['id'];
				
				$sql = "INSERT INTO hostime_support_post (sup_id, username, reponse, stamp) VALUES(".$_GET['id'].", '".mysql_escape_string($_SESSION['user'])."', '".mysql_escape_string($_POST['reponse'])."', UNIX_TIMESTAMP())";
				mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
			}
			
			
			$sql = "SELECT * FROM hostime_support_tickets WHERE id = " . $_GET['id'];
			$req = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
			
			while($data = mysql_fetch_array($req))
			{
				echo '<a href="support.php" class="btn" ><i class="icon-chevron-left" ></i> retour</a><br /><br />';
			
			
				// echo "Utilisateur: " . $data['username'] . ($data['vip'] == 1 ? ' <b style="color:green;" >VIP</b>' : '') ."<br />";
				echo 'Mail <span class="badge badge-success" >' . $data['mail'] . '</span><br /><br />';
				// echo "Date: " . date('d/m à H:i', $data['stamp']) . "<br />";
				
				echo '<div class="well" style="width:700px;" >';
				
				echo '<div class="pull-left" >'. ucfirst($data['username']) . '</div> <div class="pull-right" >'. date('d/m à H:i', $data['stamp']) .'</div>';
				
				echo '<br />';
				
				echo '<hr style="height:5px; background-color: grey;" />';
				
				echo str_replace("\'", "'", $data['detail']);
				
				echo '</div>';

				// $rep = str_replace("\'", "'", $data['admin_rep']);
			
			}
			
			$sql = "SELECT * FROM hostime_support_post WHERE sup_id = " . $_GET['id'];
			$req = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
			
			while($data = mysql_fetch_array($req))
			{
				// echo "Date: " . date('d/m à H:i', $data['stamp']) . "<br />";
				
				
				echo '<div class="well" style="width:700px;" >';
				
				if($data['admin'] == 1)
					echo '<img src="admin/staff.png" style="margin-bottom:-60px; position:relative; top:-23px;right:-'.(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false ? 561 : 560).'px;">';
				
				echo '<div class="pull-left" >'. ucfirst($data['username']) . '</div> <div class="pull-right" >'. date('d/m à H:i', $data['stamp']) .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
				
				echo '<br />';
				
				// echo '<div class="well" style="width:500px;" >';
				echo '<hr style="height:5px; background-color: grey;" />';
				
				echo str_replace("\'", "'", $data['reponse']);
				
				// echo '</div>';
				echo '</div>';
				
				// $rep = str_replace("\'", "'", $data['admin_rep']);
			
			}
			
			mysql_close();
			echo '<br />';
			
			?>
			<form method="post" action="#" >
				<h2>Entrez une réponse ...</h2>
				<textarea name="reponse" style="width:500px; height:150px;" ></textarea><br />
				<input type="submit" class="btn btn-warning" />
			</form>
	</div>
	
	<?
	}
	else
	{
		?>
			<div class="well" style="max-width: 800px; margin: 0 auto 10px;">
		<h1>Créer un nouveau ticket</h1>
	<p>
		Vous avez un problème ? Vous voulez nous faire part d'une remarque ou nous poser une question ? <br /><br />
		Envoyez-la nous en suivant le formulaire suivant ou rejoignez-nous tout simplement sur le <a href="ts3server://ts.hostime.eu/?port=9987">teamspeak3</a>
	</p><br />
	
	<?
	
		if($send)
		{
			echo '<div class="alert alert-success">
			  <h4>Ticket envoyé</h4>
				Vous serez notifié par mail ('.$_POST['nom'].') et sur le site de la réponse du support, merci de votre patience.
			</div>';
		}
	
	?>
	
	
	<center><form action="#" method="post" name="myform" >
					<label for="nom2">Nom de compte: </label><input type="text" name="nom2" value="<? echo $_SESSION['user']; ?>" disabled /><br/>
					<br /><label for="sujet">Type de problème: </label>
					<select name="sujet" style="width:300px;">
						<option value="Probleme de connection à son compte">Probleme de connection à son compte </option>
						<option value="Probleme vis à vis des commandes"> Probleme vis à vis d'une commande </option>
						<option value="Réseau"> Réseau </option>
						<option value="Autres"> Autres </option>
					</select><br/><br/>
					<label for="nom">e-mail de contact</label>
					<input type="email" name="nom" value="<? echo $_SESSION['mail']; ?>"/><br/><br/>
					
					<label for="ticket">Description du problème: </label>
					<textarea name="ticket" rows="10" cols="200" style="width:600px; resize: none; " maxlength="500" placeholder="Expliquez ici votre probleme ou posez votre question (500 charactères maximum)" ></textarea><br/>
					<!-- <input type="submit" value="Soumettre" class="btn btn-warning" onclick="alert('Ticket envoyé !');" />
					<input type="submit" value="Soumettre" class="btn btn-warning" onclick="javascript: submitform()" /> !-->
					<a href="javascript: submitform()" class="btn btn-warning">Soumettre</a>
					<input type="reset" value="Effacer" class="btn" />
				</form></center>
				
	
	</div>
		
			<div class="well" style="max-width: 800px; margin: 0 auto 10px;">
			<h1>Mes tickets</h1><br />
				<table class="table table-striped table-bordered" >
				
				<thead>
					<tr>
						<th>Contact</th>
						<th>Sujet</th>
						<th>Status</th>
						<th>Date</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?
						$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
						mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
						mysql_query("SET NAMES 'utf8'");
						
						$sql = "SELECT * FROM hostime_support_tickets WHERE username = '" . $_SESSION['user'] . "'";
						// echo $sql;
						$req = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
						
						while($data = mysql_fetch_array($req))
						{
							echo '<tr>';
							
							echo '<td>'.$data['mail'].'</td>';
							echo '<td>'.$data['sujet'].'</td>';
							echo '<td><center>'.($data['actif'] == 1 ? '<a href="support.php?action=close&id='.$data['id'].'" class="btn btn-success" >Ouvert</a>' : '<a href="support.php?action=open&id='.$data['id'].'" class="btn btn-danger" >Fermé</a>').'</center></td>';
							echo '<td>'.date('d/m/Y à H:i', $data['stamp']).'</td>';
							echo '<td><center>';
							
							echo '<a href="support.php?action=show&id='.$data['id'].'" class="btn btn-warning" >Lire</a>';
							
							echo '</center></td>';
							echo '</tr>';
						}
						
						mysql_close();
					?>
				</tbody>
				
				</table>
			</div>
			
			<!-- Add validations to the form-->
<script type="text/javascript">
var myformValidator = new Validator("myform");
myformValidator.addValidation("sujet", "req", "Tout les champs doivent être remplis !");
myformValidator.addValidation("nom", "req", "Tout les champs doivent être remplis !");
myformValidator.addValidation("ticket", "req", "Tout les champs doivent être remplis !");
</script>
 
<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 if(document.myform.onsubmit())
 {//this check triggers the validations
    document.myform.submit();
 }
}
</script>
			
		<?
	}
	?>
	
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