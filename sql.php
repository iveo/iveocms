<?
// include('fonction.php');

if(GetPageName() == "sql.php")
{
	die('Vous ne pouvez pas accéder à cette page !');
}

define('DB_HOST', 'localhost');
define('DB_SELECT', "");
define('DB_USERS', "");
define('DB_PWD', "");

?>