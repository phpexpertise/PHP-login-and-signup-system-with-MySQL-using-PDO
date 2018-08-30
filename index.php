<?php
require_once("config.php");
require_once("user.php");
$userobj	=	new User($db_connect);
if($userobj->is_logged()!=""){
	$userobj->redirect('dashboard.php');
}

$error = "";

if(isset($_REQUEST['login-submit'])){
	extract($_REQUEST); // to get the input values

	// If inputs are valid
	if($username AND $password) {
		if($userobj->login($username,$password)){
			if (isset($remember) && $remember == 'on') {
			/* Set Cookie from here for one hour */
			setcookie("username", $username, time()+(60*60*1));
			setcookie("password", $password, time()+(60*60*1));  /* expire in 1 hour */
			setcookie("remember", $remember, time()+(60*60*1));  /* expire in 1 hour */
		  } else {
			setcookie("username", $username, time()-1);
			setcookie("password", $password, time()-1);
			setcookie("remember", $remember, time()-1);
		  }
		  $userobj->redirect("dashboard.php");
		} else {
			$error =	$userobj->set_error('wrong_username_and_password');
		}
	}
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PHP Login Form with PDO</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="css/style.css" type="text/css"  />
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top: 100px;">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form id="login-form" method="post" onsubmit="return validateForm(this);" class="form-horizontal">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="text-center">
							<a href="javascript:void(0);" class="btn btn-primary" id="login-form-link">Login</a>
							<a href="register.php" id="register-form-link" class="btn btn-warning">Register</a>
						</p>
					</div>
					<div class="panel-body">
						<?php if($error!="") { ?>
							<div class="alert alert-danger">
								<i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
							</div>
						<?php } ?>
						<div class="form-group" style="padding: 10px;">
							<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username']; } ?>">
							<span id="username_error"></span>
						</div>
						<div class="form-group" style="padding: 10px;">
							<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
							<span id="password_error"></span>
						</div>
						<div class="form-group text-center" style="padding: 10px;">
							<input type="checkbox" tabindex="3" value="on" name="remember" id="remember"  <?php if(isset($_COOKIE['password'])){ echo "checked='checked'"; } ?>>
							<label for="remember"> Remember Me</label>
						</div>
						<div class="form-group text-center">
							<button type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-primary">Log In</button>
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