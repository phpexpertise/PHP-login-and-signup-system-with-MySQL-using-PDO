<?php session_start();
ob_start();

define('HOSTNAME',"localhost");
define('USERNAME',"root");
define('PASSWORD',"");
define('DATABASE',"test");

try{	
	$db_connect	=	new PDO("mysql:host=".HOSTNAME.";dbname=".DATABASE."",USERNAME,PASSWORD);
}
catch(PDOException $e){
	echo $e->getMessage();
}


?>