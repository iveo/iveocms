	<header id="header">

		<!-- Navigation
		================================================== -->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container" style="width:70%;">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="btn btn-danger btn-xlarge" href="index.php" >
						<!-- <img src="http://dev.moul.eu/mogo/img/logo.png" height="42" width="150" /> !-->
						<b>Administration</b>
					</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li><a href="../index.php">Retour au Site</a></li>
							<li <? if(GetPageName() == "index.php")	echo 'class="active"'; ?>><a href="index.php">Accueil</a></li>
							<!-- 
							 !-->
							<li <? if(GetPageName() == "admin_hebergement.php")	echo 'class="active"'; ?>><a href="admin_hebergement.php">Hebergements</a></li>
							<li <? if(GetPageName() == "admin_domaines.php")	echo 'class="active"'; ?>><a href="admin_domaines.php">Domaines</a></li>
							
							
	
							
							<li <? if(GetPageName() == "ticket.php")	echo 'class="active"'; ?>><a href="ticket.php">Support</a></li>
							
							<li <? if(GetPageName() == "admin_contact.php")	echo 'class="active"'; ?>><a href="admin_contact.php">Contact</a></li>
							
							<li <? if(GetPageName() == "admin_users.php")	echo 'class="active"'; ?>><a href="admin_users.php">Utilisateurs</a></li>
							
							
							
					  <?
						// if(isset($_SESSION['user']) && $_SESSION['user'] != '')
						// {
							// $show = $_SESSION['user'];
							// if(strlen($show) > 10)
							// {
								// $ar = str_split($show, 10);
								// $show = $ar[0] . '...';
							// }
							// echo '<li>';
							// echo '<a href="javascript: void(0)"><b>' . $show . '</b> - '.$_SESSION['tokens'].' tokens</a>'; 
							
							// echo '</li>';
						// }
					  
					  ?>
							
						</ul>
						
					</div><!--/.nav-collapse -->
				</div><!-- end .container -->
			</div><!-- end .navbar-inner -->
		</div><!-- end .navbar -->

	</header>