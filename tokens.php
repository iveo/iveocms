<?
session_start(); 
	include('fonction.php');
	include('sql.php');
	include('refresh.php');
	
	if(!isset($_SESSION['user']) || $_SESSION['user'] == '')
{
	redirect('login.php?error=1&red=tokens', 0);
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
	<title>Hostime - Recharger vos tokens </title>
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
	
	
	<?
	if(isset($_COOKIE['screenresolution'])) {
	 //cookie found!
	 $screenres = $_COOKIE['screenresolution'];
	} else {
	 //cookie is not found, so set it with JavaScript
	?>
	 <script language="javascript">
	 <!--
	 writeCookie();
	 function writeCookie() {
	  var enddate = new Date("December 31, 2060");
	  document.cookie = "screenresolution="+ screen.width +"x"+ screen.height + ";expires=" + enddate.toGMTString();
	  window.location.replace("<?= $_SERVER['PHP_SELF'] .'?'.$_SERVER['QUERY_STRING']  ?>");
	 }
	 //-->
	 </script><?
	}
	?>
</head>
<body>

<!--
<script type="text/javascript">
<!--
jQuery(document).ready( function () {
	// On cache les sous-menus
	// sauf celui qui porte la classe "open_at_load" :
	$("ul.subMenu:not('.open_at_load')").hide();
	// On selectionne tous les items de liste portant la classe "toggleSubMenu"

	// et on remplace l'element span qu'ils contiennent par un lien :
	$("li.toggleSubMenu span").each( function () {
		// On stocke le contenu du span :
		var TexteSpan = $(this).text();
		$(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '<\/a >') ;
	} ) ;

	// On modifie l'evenement "click" sur les liens dans les items de liste
	// qui portent la classe "toggleSubMenu" :
	$("li.toggleSubMenu > a").click( function () {
		// Si le sous-menu etait deja ouvert, on le referme :
		if ($(this).next("ul.subMenu:visible").length != 0) {
			$(this).next("ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") } );
		}
		// Si le sous-menu est cache, on ferme les autres et on l'affiche :
		else {
			$("ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") } );
			$(this).next("ul.subMenu").slideDown("normal", function () { $(this).parent().addClass("open") } );
		}
		// On empeche le navigateur de suivre le lien :
		return false;
	});

} ) ;
// -->
<!-- </script> !-->

	<!-- Header
	================================================== -->
	<?
	include('header.php');
	?>

	<!-- Content
	================================================== -->
	<div id="content" class="container">
	<div class="hero-unit">
		<div class="ac">
			<h1>Rechargez vos tokens</h1>
			<p>Grace à cette page vous pourrez recharger votre compte en tokens et commander des services	.</p>
		</div>
	</div>
   

	<div class="well" style="max-width: 400px; margin: 0 auto 10px;">
	
	<!-- <div id="starpass_128773"></div>
<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=128773&amp;datas=">
</script>
<noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br />
<a href="http://www.starpass.fr/">Micro Paiement StarPass</a>
</noscript>
<div id="starpass_128773"></div>
<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=128773&amp;verif_en_php=1&amp;datas=">
</script>
<noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br />
<a href="http://www.starpass.fr/">Micro Paiement StarPass</a>
</noscript>
	<br />
	<br /> !-->
	<br />
	
	
	
	
 <a href="#starpass" role="button" class="btn btn-large btn-block btn-primary" data-toggle="modal"><img src="img/starpass.gif" /> Cr&eacute;diter par Starpass</a>

<hr />
<a href="#paypal" role="button" class="btn btn-large btn-block" data-toggle="modal"><img src="img/paypal.png" /> Cr&eacute;diter par Paypal</a>
</div>	</div>

<!-- SYSTEME STARPASS ICI -->

<div id="starpass" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Starpass</h3>
  </div>
  <div class="modal-body">
<!--
<div id="starpass_128773"></div>
<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=128773&amp;verif_en_php=1&amp;datas=">
</script>
<noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br />
<a href="http://www.starpass.fr/">Micro Paiement StarPass</a>
</noscript>--><center><iframe src="http://script.starpass.fr/iframe/kit_default.php?idd=128773&background=FFFFFF&theme=white_grey_small&amp;verif_en_php=1" width="100%" height="380" scrolling="no" frameborder="0"></iframe></center>  

</div>
  <div class="modal-footer">
    Le payement Starpass est automatique !
  </div>
</div>

 		<!-- SYSTEME PAYPAL ICI -->

<div id="paypal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Paypal</h3>
  </div>
  <div class="modal-body">
<center>

	
	
	
	<!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="8QBRLGA98DQFY">
		
		<input type="hidden" name="business" value="hostime.eu@gmail.com">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="amount" value="1.30">
		<input type="hidden" name="return" value="http://dev.moul.eu/mogo/tokens.php">
		<input type="hidden" name="notify_url" value="http://dev.moul.eu/mogo/tokens_check2.php">
		<input type="hidden" name="custom" value="<?php //echo $_SESSION['id']; ?>"/>
		
		<span class="btn">Recharger 1 token (1.30 € TTC)</span> 
		<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - la solution de payement en ligne la plus simple et la plus sécurisée !">
		<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>
	

	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="U45XKSFUVRXV6">
		
		<input type="hidden" name="business" value="hostime.eu@gmail.com">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="amount" value="1.30">
		<input type="hidden" name="return" value="http://dev.moul.eu/mogo/tokens.php">
		<input type="hidden" name="notify_url" value="http://dev.moul.eu/mogo/tokens_check2.php">
		<input type="hidden" name="custom" value="<?php ///echo $_SESSION['id']; ?>"/>
		
		<span class="btn">Recharger 5 tokens (6.40 € TTC)</span> 
		<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
		<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form> !-->

	
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="A9F6EVBVWF57G">
		<table>
		<tr><td><input type="hidden" name="on0" value="Nombre de Token(s)">Nombre de Token(s)</td></tr><tr><td><select name="os0">
			<option value="1 token">1 token €1,30 EUR</option>
			<option value="5 tokens">5 tokens €5,40 EUR</option>
			<option value="10 tokens">10 tokens €10,60 EUR</option>
			<option value="20 tokens">20 tokens €20,95 EUR</option>
			<option value="30 tokens">30 tokens €31,00 EUR</option>
		</select> </td></tr>
		</table>
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="custom" value="<?php echo $_SESSION['id']; ?>"/>
		<input type="hidden" name="return" value="http://dev.moul.eu/mogo/tokens.php">
		<input type="hidden" name="notify_url" value="http://dev.moul.eu/mogo/tokens_check2.php">
		<input type="hidden" name="business" value="hostime.eu@gmail.com">
		<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
		<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>

	
	

</center>
</div>
  <div class="modal-footer">
    Le payement Paypal est automatique !
  </div>
</div>     
      <br /><br /><br />
     	<!-- FIN DES SYSTEMES DE PAIEMENTS !!!! --> 
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