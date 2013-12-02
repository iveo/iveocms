<?php
session_start();
include('../fonction.php');
include('../sql.php');
require_once( '../api/whm.class.php' );

if(!isset($_SESSION['user']) || $_SESSION['user'] == '' || $_SESSION['root'] == false)
{
	header('Location: ../index.php');
	
}
	
$page = "accueil";

if(isset($_GET['page']))
{
	if($_GET['page'] == "validation")
	{
		$page = $_GET['page'];
	}
}

$action = "";
if(isset($_GET['action']))
{
	if($_GET['action'] == "accept" || $_GET['action'] == "deny" || $_GET['action'] == "waiting")
	{
		$action = $_GET['action'];
	}
}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Admin Panel - Gestion des hébergements</title>
	<link type="images/ico" rel="shortcut icon" href="../img/server.png" />
	<meta name="description" content="Page description">
	<meta name="author" content="Your name">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Custom css -->
	<link href="../css/style.min.css" rel="stylesheet">

	<link href="../css/font-awesome/font-awesome.css" rel="stylesheet">
	<!--[if IE 7]>
		<link href="css/font-awesome/font-awesome-ie7.css" rel="stylesheet">
	<![endif]-->

	<!-- Load Open sans from Google Font Directory -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
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
	
	<br />
	<h1>Administration des hébergements</h1>
	<br />
	<br />
	
	<?
	
		if($page == "validation")
		{
		
			echo '<h2>Validation des hébergements</h2>';
			$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");

			if($action == "")
			{
				$sql = "SELECT * FROM hostime_hebergement_file ORDER BY validated ASC";
				
				$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				
				echo '<table class="table table-condensed">
					<caption><h2>Hebergements Disponibles</h2><br /></caption>
					<thead>
						<tr>
						<th>#</th>
						<th>Sous-domaine</th>
						<th>User</th>
						<th>Status</th>
						<th>Date</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>';
				
				while($data = mysql_fetch_assoc($req))
				{
					$state = "??";
					
					if($data['validated'] == 0)	$state = "Refusé";
					if($data['validated'] == 1)	$state = "Accepté";
					if($data['validated'] == -1)	$state = "En Attente";
				
					echo '<tr>
							<td>'.$data['id'].'</td>
							<td>'.$data['sousdom'].'</td>
							<td>'.$data['user'].'</td>
							<td>'.$state.'</td>
							<td>'.date("d/m/Y - H:i:s", $data['stamp']).'</td>
							<td>
								<a href="?page=validation&action=accept&id='.$data['id'].'" class="btn btn-success">Accepter</a> &nbsp;
								<a href="?page=validation&action=deny&id='.$data['id'].'" class="btn btn-danger">Refuser</a> &nbsp;
						
							</td>
						</tr>';
				}
				echo '</tbody></table>';
			}
			else if(isset($_GET['id']))
			{
				if($action == "accept")
				{
					$sql = "SELECT * FROM hostime_hebergement_file WHERE id = ".$_GET['id']."";
				
					$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

					while($data = mysql_fetch_assoc($req))
					{
						$dom = $data['sousdom'];
						$user = $data['user'];
					}
					
					$sql = "SELECT * FROM hostime_users WHERE user = '".$user."'";
				
					$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

					$email = '';
					$id = '';
					
					while($data = mysql_fetch_assoc($req))
					{
						$id = $data['id'];
						$email = $data['email'];
					}
					
					if($email == '')
					{
						echo '<b style="color:red;">Erreur: email introuvable</b>';
					}
					else
					{
						
						
			
						$WHM = new WHM( true , '5.9.106.219' , 'firstheu' , 'apst123@' );
						
						$data = $WHM->search_account_by_user($user.'_'.$dom);
						// echo "$user<br />";
						// $data = $WHM->create_account($dom.'.hostime.eu', 'mogo123', 'test456', 'test@moul.eu', 'Basique');
						
						// print_r($data);
						
						if(isset($data['user']))
						{
							echo '<b style="color:red;">Erreur: l\'utilisateur existe déjà !</b>';
							// $user .= rand(1, 500);
						}
						else
						{
							$array = str_split($dom, 8);
							$userwhm = $array[0];
							echo "$userwhm<br />";
							$data = $WHM->create_account($dom.'.hostime.eu', $userwhm, '', $email, 'firstheu_gratuit_100');
							print_r($data);
							
							$sql = "UPDATE hostime_hebergement_file SET validated = 1 WHERE userid = ".$_GET['id']." LIMIT 1";
							mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
							
							$sql = "INSERT INTO hostime_users_hebergement (user_id, offre_id, start, expire, ip, cpanel_user, cpanel_pwd, domaine) 
																	VALUES(".$id." ,1, ".time().", ".(time()+2678400).", '".$_SERVER['REMOTE_ADDR']."', '".$data['username']."', '".$data['password']."', '".$data['domain']."')";
							mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
							
							echo $data['account_info'];
						}
					}
				}
				else if($action == "deny")
				{
					$sql = "UPDATE hostime_hebergement_file SET validated = 0 WHERE userid = ".$_GET['id']." LIMIT 1";
					mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				}
			/* 	else if($action == "waiting")
				{
					$sql = "UPDATE hostime_hebergement_file SET validated = -1 WHERE userid = ".$_GET['id']." LIMIT 1";
					mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				} */
				// redirect('admin_hebergement.php?page=validation', 0);
				
			}
			mysql_close();
			
		}
		else
		{
			echo '<a href="?page=validation" class="btn">Valider des hebergements en attente</a>';
		}
	
	?>
	
	<br />
	<br />
	<br />
	<br />
	</div>


</body>
</html>