<?php
session_start();
include('../fonction.php');
include('../sql.php');

if(!isset($_SESSION['user']) || $_SESSION['user'] == '' || $_SESSION['root'] == false)
	{
		header('Location: ../index.php');
		
	}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Hostime - Admin Panel</title>
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="../js/jquery-1.8.3.min.js"%3E%3C/script%3E'))</script>
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
	<div class="well" style="max-width: 800px; margin: 0 auto 10px;">

	<!-- <a href="admin_hebergement.php" class="btn">Administration Hebergements</a> -->

	
	<br />
	
	<h3>Note d'administration</h3>
	
	<br />
	<form method="post" action="#">
	<label for="com_add">Ajouter:</label><textarea name="com_add" style="height:200px; width:500px;"></textarea><br />
	<input type="submit" class="btn btn-info" value="Envoyer" />
	</form>
	<br />
	
	<table class="table table-hover">
	
		<thead>
			<tr>
			<th>#</th>
			<th>User</th>
			<th style="width:50%;">Message</th>
			<th>Stamp</th>
			<th> </th>
			</tr>
		</thead>
		
		<tbody>
		
		<?
		
			$db = mysql_connect("localhost", DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
			mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
			mysql_query("SET NAMES 'utf8'");

		
			$sql = "SELECT * FROM hostime_admin_note WHERE hostime_admin_note.on = 1 ORDER BY stamp DESC LIMIT 10";
				
			$req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				
			while($data = mysql_fetch_assoc($req))
			{
				$data['com'] = str_replace("\'", "'", $data['com']);
				echo '<tr>';
				
				echo '<td>'.$data['id'].'</td>';
				echo '<td>'.$data['user'].'</td>';
				echo '<td>'.$data['com'].'</td>';
				echo '<td>'.date("d/m/Y H:i:s", $data['stamp']).'</td>';
				echo '<td><a href="index.php?action=del&id='.$data['id'].'"><div class="btn btn-danger">X</div></a></td>';
				
				echo '</tr>';
			}
			
			if(isset($_POST['com_add']))
			{
				$_POST['com_add'] = mysql_escape_string($_POST['com_add']);
				$sql = "INSERT INTO hostime_admin_note (user, com, stamp) VALUES('".$_SESSION['user']."', '".$_POST['com_add']."', ".time().")";
				
				mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			}
			
			if(isset($_GET['action']) && $_GET['action'] == "del" && isset($_GET['id']))
			{
				// $_POST['com_add'] = mysql_escape_string($_POST['com_add']);
				// $sql = "INSERT INTO hostime_admin_note (user, com, stamp) VALUES('".$_SESSION['user']."', '".$_POST['com_add']."', ".time().")";
				
				$sql = "UPDATE hostime_admin_note SET hostime_admin_note.on = 0 WHERE id = ".$_GET['id']."";
				
				mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			}
			
			mysql_close();
		
			if(isset($_POST['com_add']) || (isset($_GET['action']) && $_GET['action'] == "del" && isset($_GET['id'])))
				redirect('index.php', 0);
		?>
		
		</tbody>	
	</table>
	
	</div>
	</div>

	<?
		include('../footer.php');
	?>

	<!-- Javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="../js/jquery.touchSwipe.js"></script>
	<script type="text/javascript" src="../js/jquery.hotkeys.min.js"></script>
	<script type="text/javascript" src="../js/functions.min.js?v=2"></script>

</body>
</html>