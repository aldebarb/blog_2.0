<?php
require '../includes/config.php';

if (!$userLoggedIn->isLoggedIn()) {
	header("location: ../login/index.php");
}

$deleteForum = new Forum($_GET['postId']);
$deleteForum->deletePost($mysqli);
header("location: ../home.php");
?>