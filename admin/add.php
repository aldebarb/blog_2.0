<?php

if (isset($_POST['submit'])) {

	$inputArray = array_map('removeMaliciousCode', $_POST);

	if (empty($inputArray['postTitle']) || empty($inputArray['postContent'])) {
		echo "Invalid Post";
	} else {
		$addForum = new Forum(0);
		$addForum->userId = $_SESSION['userId'];
		$addForum->postTitle = $inputArray['postTitle'];
		$addForum->postContent = $inputArray['postContent'];
		$addForum->postDate = strftime("%B %d, %Y");
		$addForum->postTime = strftime("%X");
		$addForum->save($mysqli);
		header("location: home.php");
	}
}
?>

<form method="post" action="">
	<p>Title</p>
	<input type="text" name="postTitle" maxlength="32"><br>
	<p>Post</p>
	<textarea name="postContent" rows="3", cols="40" maxlength="120"></textarea>
	<input type="submit" name="submit" value="Post">
</form>
