<?php 
session_start();

define('DBHOST', 'localhost');
define('DBUSER', 'username');
define('DBPASS', 'password');
define('DBNAME', 'databasename');

$mysqli = new mysqli('DBHOST', 'DBUSER', 'DBPASS', 'DBNAME');

if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

date_default_timezone_set('America/New York');

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