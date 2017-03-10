<?php 
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'blog_db');

if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

date_default_timezone_set('America/New_York');

function __autoload($class)
{
	$class = strtolower($class);
	$classPath = 'classes/' . $class . '.php';

	if (file_exists($classPath)) {
		require $classPath;
	}

	$classPath = '../classes/' . $class . '.php';
	if (file_exists($classPath)) {
		require $classPath;
	}

	$classPath = '../../classes/' . $class . '.php';
	if (file_exists($classPath)) {
		require $classPath;
	}
}

$userLoggedIn = new UserLogin($mysqli);
?>