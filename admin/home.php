<?php
require '../includes/config.php';

if (!$userLoggedIn->isLoggedIn()) {
	header("location: ../login/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>

<form method="get" action="add.php">
    <h2>Make a new post?</h2>
    <input type="submit" name="addPost" value="Add Post">
    <a href="../login/logout.php">Click to Logout.</a>
</form>

<?php

$result = $mysqli->query("SELECT forum.post_title, user_login.email_address, forum.post_date, forum.post_time, forum.post_blog, forum.post_id FROM forum JOIN user_login ON forum.user_id = user_login.user_id ORDER BY forum.post_id DESC");

if ($result->num_rows > 0) {
			
	while ($row = $result->fetch_assoc()) {
		print "<h2>" . $row['post_title'] . "</h2>";
		print "<p>" . $row['post_blog'] . "</p>";
		print "<p>Posted by " . $row['email_address'] . " on " . $row['post_date'] . " at " . $row['post_time'] . "</p>";

		print "<form method='post' action='delete.php?postId=" . $row['post_id'] . "'>";
		print "<input type='submit' name='delete' value='Delete'>";
		print "<a href='/edit.php?postId=" . $row['post_id'] . "'>Edit Post?</a>";
	}
}
		



?>
</body>
</html>