<?php
session_start();
require 'includes/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog 2.0 Login</title>
</head>
<body>

<?php

if (isset($_POST['submit'])) {
	
}
?>

<h2>Welcome to Blog_2.0</h2>
<form>
	<label>Enter your login Information</label>
	Username: <input type="text" name="emailAddress"><br>
	Password: <input type="password" name="password">
	<input type="submit" name="submit" value="Login">
</form><br>

<p>Don't have an account? <a href="register.php">Click here and join today!</a></p>
<p><a href="guest/index.php">Veiw the blog as a guest</a></p>
</body>
</html>