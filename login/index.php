<?php
require '../includes/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog 2.0 Login</title>
</head>
<body>

<?php

if (isset($_POST['submit'])) {
	
	extract($_POST);

	if ($userLoggedIn->login($emailAddress, $password)) {
		$user = new User($userLoggedIn->userId);
		$user->loadUser($mysqli);
		$_SESSION['userId'] = $userLoggedIn->userId;
		$_SESSION['loggedIn'] = true;
		header("location: ../home.php");
	}
}
?>

<h2>Welcome to Blog_2.0</h2>
<form method="post" action="">
	<label>Enter your login Information</label><br>
	Username: <input type="text" name="emailAddress"><br>
	Password: <input type="password" name="password">
	<input type="submit" name="submit" value="Login">
</form><br>

<p>Don't have an account? <a href="register.php">Click here and join today!</a></p>
<p><a href="guest/index.php">Veiw the blog as a guest</a></p>
</body>
</html>