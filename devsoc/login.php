<?php include('serverdev.php')?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form method="post" action="login.php">
		<?php include('errors.php')?>
	<input type="text" name="employeeid">
	<input type="password" name="password">
	<button type="submit" name="login_user">Login</button>

   </form>
<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
</body>
</html>