<?php

if (isset($_POST['submit'])) {
	$_POST = array_map('removeMaliciousCode', $_POST);
	extract($_POST);

	if ($userLoggedIn->login($emailAddress, $password)) {
		$user = new User($userLoggedIn->userId);
		$user->loadUser($mysqli);
		$_SESSION['userId'] = $userLoggedIn->userId;
		$_SESSION['loggedIn'] = true;
		header("location: home.php");
	}
}
?>

<form method="post" action="">
	<h2>Enter your login Information</h2><br>
	Username: <input type="text" name="emailAddress"><br>
	Password: <input type="password" name="password">
	<input type="submit" name="submit" value="Login">
</form><br>

