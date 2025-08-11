<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In | Employee Management System</title>
	<link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
	<header>
		<nav>
			<h1>Employee Management System</h1>
			<ul id="navli">
				<li><a href="index.php" class="<?= $current_page == 'index.php' ? 'homered' : 'homeblack' ?>">HOME</a></li>
				<li><a href="elogin.php" class="<?= $current_page == 'elogin.php' ? 'homered' : 'homeblack' ?>">Employee Login</a></li>
				<li><a href="alogin.php" class="<?= $current_page == 'alogin.php' ? 'homered' : 'homeblack' ?>">Admin Login</a></li>
			</ul>
		</nav>
	</header>
	<div class="divider"></div>

	<div class="loginbox">
	    <img src="assets/admin.png" class="avatar" alt="Admin Avatar">
	    <h1>Login Here</h1>
	    <form action="process/aprocess.php" method="POST">
	        <p>Email</p>
	        <input type="text" name="mailuid" placeholder="Enter Email Address" required>
	        <p>Password</p>
	        <input type="password" name="pwd" placeholder="Enter Password" required>
	        <input type="submit" name="login-submit" value="Login">
	    </form>
	</div>
</body>
</html>
