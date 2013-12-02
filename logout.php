<?
session_start(); 
	// setcookie('user', '', time() + 1*24*3600, null, null, false, true);
	// setcookie('mail', '', time() + 1*24*3600, null, null, false, true);
	// setcookie('tokens', '', time() + 1*24*3600, null, null, false, true);
	// setcookie('co', "false", time() + 1*24*3600, null, null, false, true);
session_destroy();
	header('Location: index.php');

?>