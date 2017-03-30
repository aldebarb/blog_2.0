<?php 
require '../includes/config.php';
require '../includes/formUtility.php';

if (!$userLoggedIn->isLoggedIn()) {
	header("location: ../login/index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Post</title>
</head>
<body>

<?php

if (isset($_POST['submit'])) {
	//$_SESSION['userId'];
	$inputArray = array_map('removeMaliciousCode', $_POST);
	$time = strftime("%X");
	$date = strftime("%B %d, %Y");

	if (empty($inputArray['postTitle']) || empty($inputArray['postContent'])) {
		echo "Invalid Post";
	} else {
		$addForum = new Forum(0);
		$addForum->postTitle = $inputArray['postTitle'];
		$addForum->postContent = $inputArray['postContent'];
		$addForum->postDate = strftime("%B %d, %Y");
		$addForum->postTime = strftime("%X");
		$addForum->userId = $_SESSION['userId'];
		$addForum->save($mysqli);
	}
}
?>

<form method="post" action="">
	<input type="text" name="postTitle" maxlength="32"><br>
	<p>Post</p>
	<textarea name="postContent" rows="3", cols="40" maxlength="120"></textarea>
	<input type="submit" name="submit" value="Post">
</form>

</body>
</html>