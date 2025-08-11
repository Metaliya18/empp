<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $position = htmlspecialchars(trim($_POST['position']));
    $department = htmlspecialchars(trim($_POST['department']));

    if ($name && $email && $position && $department) {
        $file = fopen("employees.csv", "a");
        fputcsv($file, [$name, $email, $position, $department]);
        fclose($file);
        $message = "Employee registered successfully!";
    } else {
        $message = "Please fill all the fields.";
    }
}
?>

<!DOCTYPE html>

<html>
<head>
	<title>Employee Management System</title>
	<link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styleindex.css">
</head>
<body>
	<header>
		<nav>
			<h1>Employee Management System</h1>
			<ul id="navli">
				<li><a class="homeblack" href="index.php">HOME</a></li>
				<li><a class="homered" href="contact.php">CONTACT</a></li>
				<li><a class="homeblack" href="elogin.php">LOG IN</a></li>
				<li><a class="homeblack" href="employee_registration.php">REGISTER</a></li>


			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>
	<div id="divimg">
		
	</div>

	
	<img src="emp.jpg" style="float: left; margin-right: 100px; margin-top: 35px; margin-left: 70px">
	

	<div style="margin-top: 175px">
		<style>
@import url('https://fonts.googleapis.com/css2?family=Bitcount+Grid+Single:wght@100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Mukta:wght@200;300;400;500;600;700;800&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Outfit:wght@100..900&family=Winky+Rough:ital,wght@0,300..900;1,300..900&display=swap');
</style>
		<h1 style="font-family: 'Josefin Sans', cursive; font-weight: 200; font-size: 50px; margin-top: 100px; text-align: center;">Welcome to Employee Management System.</h1>

		<p style="font-family: 'Josefin Sans', sans-serif; font-size: 30px ; text-align: center;"> 1) Metaliya Unnat G.</p>
		<p style="font-family: 'Josefin Sans', sans-serif; font-size: 30px ; text-align: center;"> 2) Sarkhedi Mahek S.</p>
	</div>
		
	<!-- Employee Registration Form 
	<div style="max-width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ccc;">
		<h2 style="text-align:center;">Employee Registration</h2>

		<?php if ($message): ?>
			<p style="color: green; font-weight: bold; text-align:center;"><?php echo $message; ?></p>
		<?php endif; ?>

		<form method="POST" action="">
			<label for="name">Full Name:</label><br>
			<input type="text" id="name" name="name" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

			<label for="email">Email:</label><br>
			<input type="email" id="email" name="email" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

			<label for="position">Position:</label><br>
			<input type="text" id="position" name="position" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

			<label for="department">Department:</label><br>
			<input type="text" id="department" name="department" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

			<button type="submit" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Register</button>
		</form>
	</div>-->

</body>
</html>
