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
					<a class="brand" href="index.php">
						<img src="http://img11.hostingpics.net/pics/256834Nuoshost.png" style="margin-top: -20px;height: 60px;" />
					</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li <? if(GetPageName() == "index.php")	echo 'class="active"'; ?>><a href="index.php">Accueil</a></li>
							<!-- 
							 !-->
							<li <? if(GetPageName() == "hebergement.php")	echo 'class="active"'; ?>><a href="hebergement.php">Hebergements</a></li>
							<li <? if(GetPageName() == "domaines.php")	echo 'class="active"'; ?>><a href="domaines.php">Domaines</a></li>
						
							<?
							if(isset($_SESSION['user']) && $_SESSION['user'] != '')
							{
							?>
							<li <? if(GetPageName() == "support.php")	echo 'class="active"'; ?>><a href="support.php">Support</a></li>
							<?
							}
							else
							{
							?>
							<li <? if(GetPageName() == "contact.php")	echo 'class="active"'; ?>><a href="contact.php">Contact</a></li>
							<?
							}
							?>
							<li <? if(GetPageName() == "about.php")	echo 'class="active"'; ?>><a href="about.php">A propos</a></li>
							<li class="dropdown">
                        
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon compte<?
							// if(isset($_SESSION['user']) && $_SESSION['user'] != '')
							// {
								// $show = $_SESSION['user'];
								// if(strlen($show) > 10)
								// {
									// $ar = str_split($show, 10);
									// $show = $ar[0] . '...';
								// }
								// echo ' (' . $show . ')'; 
							// }?>
							<b class="caret"></b></a>
							<ul class="dropdown-menu">
							  <?
							  if(isset($_SESSION['user']) && $_SESSION['user'] != '')
							  {
							  ?>
								<li><a href="ucp.php">Panel Utilisateur</a></li>
								
								<?php
								if($_SESSION['root'] == true)
								{
								
								echo'<li><a href="admin/">Panel Admin</a></li>';	
								
								 }

								?>
								<li><a href="tokens.php">Recharger mes tokens</a></li>
								<li><a href="logout.php">Déconnexion</a></li>
								  
								  <!-- <li><a href="#">Something else here</a></li>
								  <li class="divider"></li>
								  <li class="nav-header">Nav header</li>
								  <li><a href="#">Separated link</a></li>
								  <li><a href="#">One more separated link</a></li> !-->
							  <?
							  }
							  else
							  {
							  ?>
								
								<li><a href="login.php">Connexion</a></li>
								<li><a href="inscription.php">Inscription</a></li>
								<!-- <li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li class="nav-header">Nav header</li>
								<li><a href="#">Separated link</a></li>
								<li><a href="#">One more separated link</a></li> !-->
							  <?
							  }
							  
							  
							  
							  ?>
							</ul>
                        
                      </li>
					  <?
						if(isset($_SESSION['user']) && $_SESSION['user'] != '')
						{
							$show = $_SESSION['user'];
							if(strlen($show) > 10)
							{
								$ar = str_split($show, 10);
								$show = $ar[0] . '...';
							}
							echo '<li>';
							echo '<a href="javascript: void(0)"><b>' . $show . '</b> - '.$_SESSION['tokens'].' tokens</a>'; 
							
							echo '</li>';
						}
					  
					  ?>
							
						</ul>
						
					</div><!--/.nav-collapse -->
				</div><!-- end .container -->
			</div><!-- end .navbar-inner -->
		</div><!-- end .navbar -->

	</header>