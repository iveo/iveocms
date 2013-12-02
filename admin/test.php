<?
function Spoil($title, $text, $on = 'Afficher', $off = 'Cacher', $img = false)
{
	echo "<div style=\"margin:20px; margin-top:5px\"><div class=\"quotetitle\"><b>".$title."</b> 
	<input type=\"button\" value=\"".$on."\" style=\"width:45px;font-size:10px;margin:0px;padding:0px;\" 
	onclick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = '';        this.innerText = ''; this.value = '".$off."'; } 
	else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = '".$on."'; }\" />
	</div><div class=\"quotecontent\"><div style=\"display: none;\">
	".$text."</div></div></div>";
}
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


<style type='text/css'>
  

.container {
    margin-top: 30px;
    width: 400px;
}
  </style>
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery-1.8.3.min.js"%3E%3C/script%3E'))</script>
	<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
var progress = setInterval(function() {
    var $bar = $('.bar');
    
    if ($bar.width()==400) {
        clearInterval(progress);
        $('.progress').removeClass('active');
    } else {
        $bar.width($bar.width()+40);
    }
    $bar.text($bar.width()/4 + "%");
}, 800);


});//]]>  

</script>
</head>
<body>

	<!-- Content
	================================================== -->
	<div id="content" class="container">
	<br><br><br><div class="progress progress-striped active">
        <div class="bar" style="width: 0%;"></div>
    </div>
    
    <object width="0" height="0"><param name="movie" value="http://www.youtube.com/v/QH2-TGUlwu4&autoplay=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/QH2-TGUlwu4&autoplay=1" type="application/x-shockwave-flash" width="0" height="0" allowscriptaccess="always" allowfullscreen="true"></embed></object>

	<? 
		Spoil('Titre', 'Texte à afficher');
	?>
	<br />
	<?php 

$string = "test"; 
$length = 200; 
$string = md5($string); 
$string_length = strlen($string); 
//determines length of above string 
srand ((double) microtime() * 1000000); 
//generates random numbers to call with rand below 
$begin = rand(0,($string_length-$length-1)); 
//picks an arbitrary starting point for random numbers using the length of the string 
$password = substr($string, $begin, $length); 
// 
print ("$password");

?>
</div>

</body>
</html>