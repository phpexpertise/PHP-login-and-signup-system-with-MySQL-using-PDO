<?php 
require_once("config.php");
require_once("user.php");
$userobj	=	new User($db_connect);
if($userobj->is_logged()==""){
	$userobj->redirect('index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Dashboard</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="css/style.css" type="text/css"  />
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div class="container">
    	<div class="row">
			<div class="col-lg-12">
				<div class="col-sm-6">
					Welcome <b><?php echo $_SESSION['username'];?></b>
				</div>
				<div class="col-sm-6">
					<a href="logout.php">Logout</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>