<?php 
session_start(); 
	include('../fonction.php');
	include('../sql.php');
	
	if(!isset($_SESSION['user']) || $_SESSION['user'] == '' || $_SESSION['root'] == false)
	{
		header('Location: ../index.php');
		
	}
	
	// include('refresh.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Ticket</title>
	
	<meta name="Contact " content="Page de contact">
	<meta name="author" content="Your name">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Custom css -->
	<link href="../css/style.min.css" rel="stylesheet">
	<link type="images/ico" rel="shortcut icon" href="../img/server.png" />
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

<!--<iframe width="100%" height="420" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=67.587586,135.263672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
	!-->
	<div class="container hero-unit" style="width:1500px;">
		<div class="bonjour">

		<center>
<?php		
if(isset($_SESSION['root']) && $_SESSION['root'] == true)
{	
	$action = "";
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
	}

	$page = "all";

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}


	echo '<a href="?page=vip" class="btn'.($page == "vip" ? ' btn-inverse' : '').'">Tickets VIP</a> 
		<a href="?page=show" class="btn'.($page == "show" ? ' btn-inverse' : '').'">Tickets normaux</a> 
		<a href="?page=all" class="btn'.($page == "all" ? ' btn-inverse' : '').'">Tout les tickets</a>
		<a href="?page=old" class="btn'.($page == "old" ? ' btn-inverse' : ' btn-info').'">Tickets fermés</a><br /><br />';


	if($action != "" && is_numeric($_GET['id']))
	{
		if($action == "close")
		{
			$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");	
			$sql = "UPDATE hostime_support_tickets SET actif = 0 WHERE id = ".$_GET['id']." LIMIT 1";
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
			mysql_close();
			redirect('ticket.php?page='.$page, 0);
		}
		else if($action == "open")
		{
			$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");
			$sql = "UPDATE hostime_support_tickets SET actif = 1 WHERE id = ".$_GET['id']." LIMIT 1";
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
			mysql_close();
			redirect('ticket.php?page=old', 0);
		}
		else if($action == "show")
		{
			$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");
			
			if(isset($_POST['reponse']))
			{
				// $sql = "UPDATE hostime_support_tickets SET admin = '".$_SESSION['user']."', admin_stamp = UNIX_TIMESTAMP(), admin_rep = '".mysql_escape_string($_POST['reponse'])."'  WHERE id = " . $_GET['id'];
				
				$sql = "INSERT INTO hostime_support_post (sup_id, username, reponse, stamp, admin) VALUES(".$_GET['id'].", '".mysql_escape_string($_SESSION['user'])."', '".mysql_escape_string($_POST['reponse'])."', UNIX_TIMESTAMP(), 1)";
				mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
			}
			
			
			$sql = "SELECT * FROM hostime_support_tickets WHERE id = " . $_GET['id'];
			$req = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
			
			while($data = mysql_fetch_array($req))
			{
				if($data['actif'] == 1)
				{
					echo '<a href="ticket.php?page='.$page.'&action=close&id='.$_GET['id'].'" class="btn btn-danger" >Fermer</a> ';
				}
				else
					echo '<a href="ticket.php?page='.$page.'&action=open&id='.$_GET['id'].'" class="btn btn-danger" >Ouvrir</a> ';
				echo '<a href="ticket.php" class="btn" >retour</a><br /><br />';
			
			
				// echo "Utilisateur: " . $data['username'] . ($data['vip'] == 1 ? ' <b style="color:green;" >VIP</b>' : '') ."<br />";
				echo "Mail: " . $data['mail'] . "<br />";
				// echo "Date: " . date('d/m à H:i', $data['stamp']) . "<br />";
				
				echo '<div class="well" style="width:700px;" >';
				
				echo '<div class="pull-left" >'. ucfirst($data['username']) . '</div> <div class="pull-right" >'. date('d/m à H:i', $data['stamp']) .'</div>';
				
				echo '<br />';
				
				echo '<hr style="height:5px; background-color: grey;" />';
				
				echo $data['detail'];
				
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
					echo '<img src="staff.png" style="margin-bottom:-60px; position:relative; top:-23px;right:-'.(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false ? 378 : 375).'px;">';
				
				echo '<div class="pull-left" >'. ucfirst($data['username']) . '</div> <div class="pull-right" >'. date('d/m à H:i', $data['stamp']) .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
				
				echo '<br />';
				
				// echo '<div class="well" style="width:500px;" >';
				echo '<hr style="height:5px; background-color: grey;" />';
				
				echo $data['reponse'];
				
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
			<?
			
		}
	}
	else if($page != "")
	{
		$type = "?";
		if($page == "all")
		{
			$type = "Tous";
		}
		else if($page == "vip")
		{
			$type = "VIP";
		}
		else if($page == "show")
		{
			$type = "Non-VIP";
		}
		else if($page == "old")
		{
			$type = "Archives";
		}
			
		// echo "<br /><b>Tickets: ".$type."</b><br />";
		echo "<table class='table table-hover'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>##</th>";
					echo "<th>User</th>";
					echo "<th>Mail</th>";
					echo "<th>Type</th>";
					echo "<th width='30%' >Détail</th>";
					echo "<th>Date</th>";
					echo "<th></th>";
				echo "</tr>";
			echo "</thead><tbody>";
		$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
		mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
		mysql_query("SET NAMES 'utf8'");	
		
		if($page == "vip")
		{
			$sql = "SELECT *
				FROM hostime_support_tickets
				WHERE vip = 1 AND actif = 1
				ORDER BY hostime_support_tickets.id DESC LIMIT 0,10";
		}
		else if($page == "show")
		{
			$sql = "SELECT *
				FROM hostime_support_tickets
				WHERE vip = 0 AND actif = 1
				ORDER BY hostime_support_tickets.id DESC LIMIT 0,10";
		}
		else if($page == "old")
		{
			$sql = "SELECT *
				FROM hostime_support_tickets
				WHERE actif = 0
				ORDER BY hostime_support_tickets.id DESC LIMIT 0,10";
		}
		else
		{
			$sql = "SELECT *
				FROM hostime_support_tickets
				WHERE actif = 1
				ORDER BY hostime_support_tickets.id DESC LIMIT 0,10";
		}
				
		$req = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
		while($data = mysql_fetch_array($req))
		{
			echo "<tr>";
			echo "<td><b style=\"color:green;\" >".($data['vip'] == 1 ? 'VIP' : '')."</b></td>";
			echo "<td><b>".$data['username']."</b></td>";
			echo "<td><b>".$data['mail']."</b></td>";
			echo "<td>".$data['sujet']."<br/></td>";
			echo "<td>".$data['detail']."</td>";
			echo "<td>Le ".date("d/m à H:i",$data['stamp'])."</td>";
			echo "<td>
			<a href='?page=".$page."&action=show&id=".$data['id']."' class='btn btn-primary' >Afficher</a> ";
			
			if($type != "Archives")	echo "<a href='?page=".$page."&action=close&id=".$data['id']."' class='btn btn-danger' >Fermer</a>";
			else	echo "<a href='?page=".$page."&action=open&id=".$data['id']."' class='btn btn-danger' >ré-ouvrir</a>";
			
			echo "</td>";
			echo "</tr>";
		}
		echo "</tbody></table>";
		mysql_close();
				

				
			
			
			
	}	
	// else
	// {
		// echo '<a href="?page=vip" class="btn">Tickets VIP</a> ';
		// echo '<a href="?page=show" class="btn">Tickets normaux</a> ';
		// echo '<a href="?page=all" class="btn">Tout les tickets</a>';
		
		
	// }
}
	
	else
	{
		// echo '<b> Il semblerait que tu te sois perdu. Click <a href="http://dev.moul.eu/mogo/">ici</a> pour revenir à l\'accueil</b>';
		redirect('../index.php', 0);
	}
	
	?>
	</center>
	<br />
	<br />
	<br />
	</div>
	</div>
	<?
		include('../footer.php');
	?>
	
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="../js/jquery.touchSwipe.js"></script>
	<script type="text/javascript" src="../js/jquery.hotkeys.min.js"></script>
	<script type="text/javascript" src="../js/functions.min.js?v=2"></script>
</body>
</html>