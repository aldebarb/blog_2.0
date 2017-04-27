<?php
require '../includes/config.php';
$userLoggedIn->logout();
header("location: ../index.php");
?>