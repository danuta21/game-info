<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login Mazen modificare</h2>
  </div>

  <form method="post" action="login.php" class="login">
  	<?php include('errors.php'); ?>
  	<div class="input-groups">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-groups">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-groups">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php" style=" background: white; ">Sign up</a>
  	</p>
  </form>
</body>
</html>
