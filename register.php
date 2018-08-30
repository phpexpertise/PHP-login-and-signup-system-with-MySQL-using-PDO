<?php
require_once("config.php");
require_once("user.php");
$userobj	=	new User($db_connect);
if($userobj->is_logged()!=""){
	$userobj->redirect('dashboard.php');
}

if(isset($_REQUEST['register-submit'])){
	extract($_REQUEST); // to get the input values

	if($username && $password) {
		if($userobj->addUser($username,$confirm_password)){
			$success = "Your account is created successfully!";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PHP Register Form with PDO</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="css/style.css" type="text/css"  />
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top: 100px;">
    	<div class="row">			
			<div class="col-md-6 col-md-offset-3">
			<form id="register-form" action="" method="post" role="form" class="form-horizontal" onsubmit="return validateForm(this);">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="text-center">
							<a href="index.php" class="btn btn-primary" id="login-form-link">Login</a>
							<a href="javascript:void(0);" id="register-form-link" class="btn btn-warning">Register</a>
						</p>
					</div>
					<div class="panel-body">
						<?php if(isset($success)){ 	?>
								<div class="alert alert-success">
								  <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $success; ?>
								</div>
						<?php } ?>
						<?php if(isset($error)){ 
							foreach($error as $error){
							?>
								<div class="alert alert-danger">
								  <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
								</div>
							<?php
							}
						} ?>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group" style="padding: 10px;">
									<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username">
									<span id="username_error"></span>
								</div>
								<div class="form-group" style="padding: 10px;">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									<span id="password_error"></span>
								</div>
								<div class="form-group" style="padding: 10px;">
									<input type="password" name="confirm_password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									<span id="confirm_password_error"></span>
								</div>
								<div class="form-group text-center">
									<button type="submit" name="register-submit" id="register-submit" tabindex="4" class="btn btn-primary">Register</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
	<script>
		function validateForm(form) {
			var error = false;
			var error_field = "";
			var username = form.username.value;
			var password = form.password.value;
			var cpassword = form.confirm_password.value;
			if (username == "") {
				error = true;
				error_field = "username";
				$("#"+error_field+"_error").html('<p class="error">Please enter Username</p>');
			}
			if (password == "") {
				error = true;
				error_field = "password";
				$("#"+error_field+"_error").html('<p class="error">Please enter Password</p>');
			}
			if (cpassword == "") {
				error = true;
				error_field = "confirm_password";
				$("#"+error_field+"_error").html('<p class="error">Please enter Confirm Password</p>');
			} else {
				if (password != cpassword) {
					error = true;
					error_field = "confirm_password";
					$("#"+error_field+"_error").html('<p class="error">Password and Confirm password sholud be same</p>');
				}
			}
			if (error) {
				$("#"+error_field).focus();
				return false;
			} else {
				return true;
			}
		}
	</script>
</body>
</html>