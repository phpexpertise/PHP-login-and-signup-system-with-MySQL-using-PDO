<?php
require_once("config.php");
require_once("user.php");
$userobj	=	new User($db_connect);
$userobj->logout();
$userobj->redirect('index.php');
?>