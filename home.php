<?php
require'includes/config.php';

if (!$userLoggedIn->isLoggedIn()) {
	header("location:login/index.php");
}

echo "Welcome Human # " . $_SESSION['userId'];

?>
