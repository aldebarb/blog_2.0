<?php
$editForum = new Forum($_GET['postId']);
$editForum->loadPost($mysqli);

if (isset($_POST['submit'])) {
	
	$inputArray = array_map('removeMaliciousCode', $_POST);

	if (empty($inputArray['postTitle']) || empty($inputArray['postContent'])) {
		echo "Invalid Post";

	} else {
		$editForum->userId = $_SESSION['userId'];
		$editForum->postTitle = $inputArray['postTitle'];
		$editForum->postContent = $inputArray['postContent'];
		$editForum->postDate = strftime("%B %d, $Y");
		$editForum->postTime = strftime("%X");
		$editForum->updatePost($mysqli);
		header("location: home.php");
	}
}
?>

<form method="post" action="">
	<p>Title</p>
	<input type="text" name="postTitle" maxlength="32" value="<?php echo $editForum->postTitle;?>"><br>
	<p>Post</p>
	<textarea name="postContent" rows="3", cols="40" maxlength="120"><?php echo $editForum->postContent;?></textarea>
	<input type="submit" name="submit" value="Edit Post">
</form>