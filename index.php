<?php 
require 'includes/config.php';
require 'includes/formUtility.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
</head>
<body>
<h2>Welcome to Char120!</h2>
<div id="menu">
	<a href="index.php">Home</a>
	<a href="index.php?p=index">Login</a>
	<a href="index.php?p=register">Register</a>
	<a href="index.php?p=guest">Guest</a>
</div>

<div id="content">
	<?php 
	$pages_dir = 'login';

	if (!empty($_GET['p'])) {
		$pages = scandir($pages_dir, 0);
		unset($pages[0], $pages[1]);
		$p = $_GET['p'];

		if (in_array($p. '.php', $pages)) {
			include ($pages_dir . '/' . $p . '.php');

		} else {
			echo "Page not found";
		}
	} else {
		include ($pages_dir . '/welcome.php');
	}
	?>
	
</div>

</body>
</html>
