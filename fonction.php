<?
/* PANEL DE GESTION D'H�BERGEMENT WEB 
	OPEN SOURCE - GRATUIT
	REVENTE INTERDITE !
*/
function GetPageName()
{
	$webpage = basename($_SERVER['PHP_SELF']);
	return $webpage;
}

if(GetPageName() == "fonction.php")
{
	die('Vous ne pouvez pas avoir acc�s � cette page !');
}

function redirect($url, $time=3) 
{      
	// if($time > 0)
	// {
   //On v�rifie si aucun en-t�te n'a d�j� �t� envoy�     
   if (!headers_sent()) 
   { 
     if($time == 0)
		header("Location: $url");  
	 else
		header("refresh: $time;url=$url");  
     
	 exit; 
   } 
   else 
   { 
     echo '<meta http-equiv="refresh" content="',$time,';url=',$url,'">'; 
   } 
   // }
   // else
   // {
		// header('Location: ../index.php');
   // }
} 

	

?>